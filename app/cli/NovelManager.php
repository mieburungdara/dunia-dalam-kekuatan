<?php

namespace App\Cli;

use Base;

class NovelManager
{
    protected $f3;

    public function __construct(Base $f3)
    {
        $this->f3 = $f3;
    }

    public function createNovel(): void
    {
        echo "\n--- Create New Novel ---\n";

        // Prompt for novel title
        echo "Enter novel title: ";
        $handle = fopen("php://stdin", "r");
        $title = trim(fgets($handle));
        fclose($handle);

        if (empty($title)) {
            echo "Error: Novel title cannot be empty.\n";
            return;
        }

        // Generate slug from title
        $slug = $this->generateSlug($title);
        echo "Generated slug: {$slug}\n";

        $novel_dir = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/cerita/' . $slug;
        if (is_dir($novel_dir)) {
            echo "Error: Novel directory already exists: {$novel_dir}\n";
            return;
        }

        // Create novel directory
        if (!mkdir($novel_dir, 0777, true)) {
            echo "Error: Failed to create novel directory: {$novel_dir}\n";
            return;
        }
        echo "Novel directory created: {$novel_dir}\n";

        // Load novel template
        $template_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/novel_data/novel_template.json';
        if (!file_exists($template_path)) {
            echo "Error: novel_template.json not found at {$template_path}\n";
            return;
        }
        $template_content = file_get_contents($template_path);
        $novel_data = json_decode($template_content, true);

        // Populate novel data from template
        $novel_data['novel_id'] = $slug;
        $novel_data['title'] = $title;
        $novel_data['slug'] = $slug;
        $novel_data['series'] = $this->f3->get('universe_name') ?? 'Pecahan Dunia'; // Default or get from F3 config

        // Save novel metadata to index.json inside novel directory
        $novel_index_path = $novel_dir . '/index.json'; // Consistent with NovelController->show_novel_index
        if (file_put_contents($novel_index_path, json_encode($novel_data, JSON_PRETTY_PRINT)) === false) {
            echo "Error: Failed to write novel index.json to {$novel_index_path}\n";
            return;
        }
        echo "Novel index.json created: {$novel_index_path}\n";

        // Add entry to series_meta.json
        $series_meta_path = $this->f3->get('ROOT') . $this->f3->get('BASE') . '/cerita/series_meta.json';
        if (!file_exists($series_meta_path)) {
            echo "Error: series_meta.json not found at {$series_meta_path}\n";
            return;
        }
        $series_meta_content = file_get_contents($series_meta_path);
        $series_meta_data = json_decode($series_meta_content, true);

        $new_series_entry = [
            'title' => $title,
            'slug' => $slug,
            'description' => $novel_data['logline'] ?? 'Deskripsi belum tersedia.'
        ];

        $series_meta_data['series'][] = $new_series_entry;

        if (file_put_contents($series_meta_path, json_encode($series_meta_data, JSON_PRETTY_PRINT)) === false) {
            echo "Error: Failed to update series_meta.json at {$series_meta_path}\n";
            return;
        }
        echo "series_meta.json updated with new novel entry.\n";

        echo "\nNovel '{$title}' created successfully!\n";
        echo "---------------------------\n";
    }

    protected function generateSlug(string $text): string
    {
        $text = preg_replace('~[^pld]+u~u', '-', $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-w_]+u~u', '', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~~', '-', $text);
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
