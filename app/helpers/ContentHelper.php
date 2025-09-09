<?php

class ContentHelper
{
    /**
     * Merender array blok konten menjadi string HTML.
     *
     * @param array $contents Array blok konten dari JSON adegan.
     * @return string HTML yang dihasilkan.
     */
    public static function render(array $contents): string
    {
        $html = '';

        foreach ($contents as $item) {
            $text = isset($item['Text']) ? htmlspecialchars($item['Text'], ENT_QUOTES, 'UTF-8') : '';
            if (empty($text)) {
                continue;
            }

            switch ($item['Type'] ?? 'unknown') {
                case 'Exposition':
                    $html .= "<p>{$text}</p>\n";
                    break;

                case 'Action':
                    $actorName = isset($item['Actor']['Name']) ? htmlspecialchars($item['Actor']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="card my-3 shadow-sm">';
                    $html .= '  <div class="card-body">';
                    $html .= "    <h6 class=\"card-subtitle mb-2 text-muted fst-italic\">Aksi oleh: {$actorName}</h6>";
                    $html .= "    <p class=\"card-text\">{$text}</p>";
                    $html .= '  </div>';
                    $html .= '</div>\n';
                    break;

                case 'InnerThought':
                    // Pikiran internal dibuat miring dan diberi tanda kutip
                    $html .= "<p class=\"inner-thought\"><i>\"";
                    $html .= "{$text}";
                    $html .= "\"</i></p>\n";
                    break;

                case 'Emotion':
                    // Emosi juga bisa diberi kelas khusus
                    $html .= "<p class=\"emotion\">{$text}</p>\n";
                    break;

                default:
                    // Abaikan tipe yang tidak dikenal secara diam-diam
                    break;
            }
        }

        return $html;
    }
}
