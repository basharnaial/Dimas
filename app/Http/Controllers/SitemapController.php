<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap
     */
    public function index(): Response
    {
        $categories = Category::select('slug', 'updated_at')->get();
        $products = Product::select('slug', 'updated_at')->get();

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        // Home page
        $xml .= $this->addUrl(url('/'), now(), 'daily', '1.0');

        // Categories
        foreach ($categories as $category) {
            $xml .= $this->addUrl(
                url("/categories/{$category->slug}"),
                $category->updated_at,
                'weekly',
                '0.8'
            );
        }

        // Products
        foreach ($products as $product) {
            $xml .= $this->addUrl(
                url("/products/{$product->slug}"),
                $product->updated_at,
                'weekly',
                '0.7'
            );
        }

        $xml .= '</urlset>';

        return response($xml, 200, [
            'Content-Type' => 'application/xml'
        ]);
    }

    /**
     * Add URL to sitemap XML
     */
    private function addUrl(string $loc, $lastmod, string $changefreq, string $priority): string
    {
        $lastmodFormatted = $lastmod ? $lastmod->toIso8601String() : now()->toIso8601String();
        
        return "  <url>\n" .
               "    <loc>{$loc}</loc>\n" .
               "    <lastmod>{$lastmodFormatted}</lastmod>\n" .
               "    <changefreq>{$changefreq}</changefreq>\n" .
               "    <priority>{$priority}</priority>\n" .
               "  </url>\n";
    }
}
