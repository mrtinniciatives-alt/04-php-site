<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function formatPrice(float $amount): string
{
    return '₦' . number_format($amount, 2);
}

function renderServiceCard(array $service): string
{
    $slug = e((string) ($service['slug'] ?? ''));
    $title = e((string) ($service['title'] ?? ''));
    $description = e((string) ($service['description'] ?? ''));
    $icon = e((string) ($service['icon'] ?? ''));
    $price = formatPrice((float) ($service['price'] ?? 0));

    return '<article class="service-card">'
        . '<span class="service-icon" aria-hidden="true">' . $icon . '</span>'
        . '<h2>' . $title . '</h2>'
        . '<p>' . $description . '</p>'
        . '<p class="service-price"><strong>' . e($price) . '</strong></p>'
        . '<a class="button" href="service.php?slug=' . $slug . '">View details</a>'
        . '</article>';
}
