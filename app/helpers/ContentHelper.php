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
                    $html .= "<p>{$text}</p>";
                    $html .= '<div class="hide small text-muted border-top mt-1 pt-1"><em>Type: Exposition</em></div>\n';
                    break;

                case 'Action':
                    $actorName = isset($item['Actor']['Name']) ? htmlspecialchars($item['Actor']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="card my-3 shadow-sm">';
                    $html .= '  <div class="card-body">';
                    $html .= "    <h6 class=\"card-subtitle mb-2 text-muted fst-italic\">Aksi oleh: {$actorName}</h6>";
                    $html .= "    <p class=\"card-text\">{$text}</p>";
                    $html .= "    <div class=\"hide small text-muted border-top mt-2 pt-2\"><em>Type: Action | Actor: {$actorName}</em></div>";
                    $html .= '  </div>';
                    $html .= '</div>';
                    break;

                case 'InnerThought':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= "<p class=\"inner-thought\"><i>\"";
                    $html .= "{$text}";
                    $html .= "\"</i></p>";
                    $html .= "<div class=\"hide small text-muted border-top mt-1 pt-1\"><em>Type: InnerThought | Character: {$charName}</em></div>\n";
                    break;

                case 'Emotion':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $intensity = isset($item['Intensity']) ? htmlspecialchars($item['Intensity'], ENT_QUOTES, 'UTF-8') : '-';
                    $html .= "<p class=\"emotion\">{$text}</p>";
                    $html .= "<div class=\"hide small text-muted border-top mt-1 pt-1\"><em>Type: Emotion | Character: {$charName} | Intensity: {$intensity}</em></div>\n";
                    break;

                default:
                    // Abaikan tipe yang tidak dikenal secara diam-diam
                    break;
            }
        }

        return $html;
    }
}
