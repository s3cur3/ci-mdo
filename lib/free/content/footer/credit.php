<?php

function ciGetThemeCredit() {
    function getLinkWithText($url, $text) {
        return "<a href=\"$url\" target=\"_blank\">$text</a>";
    }
    
    // Print a different link based on the current page ID
    global $wp_query;
    $id = $wp_query->post->ID;

    $root = "http://conversioninsights.net";
    $me = $root . "/tyler-young/";
    $designServices = $root . "/services/web-design/";
    $freeThemes = $root . "/free-wordpress-themes-for-medical-offices/";
    $paidThemes = $root . "/modern-doctors-office-premium/";
    $project = $root;

    $choices = array(
        /* Project-specific */
        getLinkWithText($freeThemes, "Free WordPress Themes for Doctor's Offices"),
        getLinkWithText($freeThemes, "Free WordPress Themes for Medical Practices"),
        getLinkWithText($freeThemes, "Free WordPress Themes for Medical Offices"),
        getLinkWithText($paidThemes, "Premium WordPress Themes for Doctor's Offices"),
        getLinkWithText($paidThemes, "Premium WordPress Themes for Medical Practices"),
        getLinkWithText($paidThemes, "Premium WordPress Themes for Medical Offices"),
        getLinkWithText($paidThemes, "Medical WordPress Theme"),
        getLinkWithText($paidThemes, "Doctor's Office WordPress Theme"),
        getLinkWithText($project, "Medical WordPress Theme by Conversion Insights"),
        getLinkWithText($project, "Doctor's Offic WordPress Theme by Conversion Insights"),
        getLinkWithText($paidThemes, "The Modern Doctor's Office WordPress Theme"),
        getLinkWithText($root, "Web Marketing for Doctor's Offices") . " by Conversion Insights",
        getLinkWithText($root, "Web Marketing for Medical Practices") . " by Conversion Insights",
        getLinkWithText($root, "Web Design for Doctor's Offices"),
        getLinkWithText($root, "Web Design for Medical Practices"),
        "Web design by " . getLinkWithText($root, "Conversion Insights"),

        /* Generic */
        "WordPress theme created by " . getLinkWithText($me, "Tyler Young") . " of Conversion Insights",
        "Medical WordPress theme by " . getLinkWithText($root, "Conversion Insights"),
        getLinkWithText($root, "Conversion Insights"),
        "Web site design by " . getLinkWithText($me, "Tyler Young") . " of Conversion Insights",
        "Designed by " . getLinkWithText($root, "Conversion Insights"),
        getLinkWithText($designServices, "Medical Practice Web Design") . " by Conversion Insights",
        getLinkWithText($designServices, "Doctor's Office Web Design") . " by Conversion Insights",
        getLinkWithText($designServices, "Web Design for Doctor's Offices"),
        getLinkWithText($designServices, "Web Design for Medical Practices"),
    );

    return $choices[ $id % count($choices) ];
}

function ciPrintThemeCredit() {
    echo ciGetThemeCredit();
}