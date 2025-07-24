package com.vendor.validation.controller;

import java.io.IOException;
import java.util.regex.Matcher;
import java.util.regex.Pattern;
import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.text.PDFTextStripper;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.multipart.MultipartFile;

@RestController
@RequestMapping("/api/vendor")
public class VendorController {

    @PostMapping("/validate")
    public ResponseEntity<String> validateVendor(
        @RequestParam("user_id") Long userId,
        @RequestParam("role") String role,
        @RequestParam("financial_score") String financialScore,
        @RequestParam("reputation") String reputation,
        @RequestParam("file") MultipartFile file
    ) {
        try {
            // Load PDF document
            PDDocument document = PDDocument.load(file.getInputStream());

            // Extract text
            PDFTextStripper pdfStripper = new PDFTextStripper();
            String text = pdfStripper.getText(document);
            document.close();

            // Print text for debugging
            System.out.println("PDF Content:\n" + text);

            // Validate Financial Score (must be >= 52 out of 100)
            String financialScorePattern = "Financial Score:\\s*(\\d+)";
            Pattern scorePattern = Pattern.compile(financialScorePattern, Pattern.CASE_INSENSITIVE);
            Matcher scoreMatcher = scorePattern.matcher(text);
            
            if (!scoreMatcher.find()) {
                return ResponseEntity.badRequest().body("❌ Financial Score not found in PDF.");
            }
            
            int financialScore = Integer.parseInt(scoreMatcher.group(1));
            if (financialScore < 52) {
                return ResponseEntity.badRequest().body("❌ Financial Score too low: " + financialScore + "/100. Minimum required: 52/100.");
            }

            // Validate Reputation (must be "average" or "respectable", not "poor")
            String reputationPattern = "Reputation:\\s*(average|poor|respectable)";
            Pattern repPattern = Pattern.compile(reputationPattern, Pattern.CASE_INSENSITIVE);
            Matcher repMatcher = repPattern.matcher(text);
            
            if (!repMatcher.find()) {
                return ResponseEntity.badRequest().body("❌ Reputation status not found or invalid. Must be: average, poor, or respectable.");
            }
            
            String reputation = repMatcher.group(1).toLowerCase();
            if ("poor".equals(reputation)) {
                return ResponseEntity.badRequest().body("❌ Poor reputation detected. Validation failed.");
            }

            // Validate Compliance ID exists
            if (!text.toLowerCase().contains("compliance id:")) {
                return ResponseEntity.badRequest().body("❌ Compliance ID not found in PDF.");
            }

            // All validations passed
            return ResponseEntity.ok("✅ Vendor passed validation. Financial Score: " + financialScore + "/100, Reputation: " + reputation + ". Facility visit scheduled.");

        } catch (IOException e) {
            e.printStackTrace();
            return ResponseEntity.internalServerError().body("Error processing PDF.");
        }
    }
}
