<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Combr\Wizard\Config\AppConfig;
use Combr\Wizard\Services\QuestionsRepository;

echo "Building static site for GitHub Pages...\n";

$distDir = dirname(__DIR__) . '/dist';
if (is_dir($distDir)) {
    // Clean old files
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($distDir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($files as $file) {
        $file->isDir() ? rmdir($file->getRealPath()) : unlink($file->getRealPath());
    }
} else {
    mkdir($distDir, 0755, true);
}

// 1. Render layout.php into index.html
$config = AppConfig::getInstance();
$questionsRepo = new QuestionsRepository();
$steps = $questionsRepo->getSteps();
$appName = $config->get('app_name');
$companyName = $config->get('company_name');
$companyUrl = $config->get('company_url');
$whatsappNumber = $config->get('whatsapp_number');

ob_start();
require dirname(__DIR__) . '/templates/layout.php';
$html = ob_get_clean();

// Make asset paths relative for GitHub Pages subfolder (/wizard-pattern/)
$html = str_replace('href="/assets/', 'href="assets/', $html);
$html = str_replace('src="/assets/', 'src="assets/', $html);

file_put_contents($distDir . '/index.html', $html);
echo "✓ Generated dist/index.html\n";

// 2. Copy Assets
function copyDir(string $src, string $dst): void {
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file !== '.') && ($file !== '..')) {
            if (is_dir($src . '/' . $file)) {
                copyDir($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

copyDir(dirname(__DIR__) . '/public/assets', $distDir . '/assets');
echo "✓ Copied assets to dist/assets\n";

// Copy docs if available
if (is_dir(dirname(__DIR__) . '/docs')) {
    copyDir(dirname(__DIR__) . '/docs', $distDir . '/docs');
    echo "✓ Copied docs to dist/docs\n";
}

// Add .nojekyll so GitHub Pages doesn't ignore anything
file_put_contents($distDir . '/.nojekyll', '');
echo "✓ Added dist/.nojekyll\n";

echo "Build complete! Static site is ready in dist/\n";
