package com.vendor.validation.controller;

import java.io.IOException;
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

            // Simple validation rules (you can customize this)
            boolean passesValidation = text.contains("Financial Score:") &&
                                       text.contains("Compliance ID:") &&
                                       text.contains("Reputation:");

            if (passesValidation) {
                // Simulate scheduling a facility visit
                return ResponseEntity.ok("✅ Vendor passed validation. Facility visit scheduled.");
            } else {
                return ResponseEntity.badRequest().body("❌ Vendor validation failed. Incomplete data.");
            }

        } catch (IOException e) {
            e.printStackTrace();
            return ResponseEntity.internalServerError().body("Error processing PDF.");
        }
    }
}
