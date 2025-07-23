package com.vendor.validation.dto;

public class VendorApplicationDto {
    private Long userId;
    private String role;
    private String financialScore;
    private String reputation;

    // Getters and setters
    public Long getUserId() {
        return userId;
    }
    public void setUserId(Long userId) {
        this.userId = userId;
    }

    public String getRole() {
        return role;
    }
    public void setRole(String role) {
        this.role = role;
    }

    public String getFinancialScore() {
        return financialScore;
    }
    public void setFinancialScore(String financialScore) {
        this.financialScore = financialScore;
    }

    public String getReputation() {
        return reputation;
    }
    public void setReputation(String reputation) {
        this.reputation = reputation;
    }
}
