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
                    $html .= "<p class=\"mb-0\">{$text}</p>";
                    $html .= '<div class="hide small text-muted border-top mt-1 pt-1"><em>Type: Exposition</em></div>';
                    break;

                case 'Action':
                    $actorName = isset($item['Actor']['Name']) ? htmlspecialchars($item['Actor']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="my-3">';
                    $html .= '  <div class="card-body">';
                    $html .= "    <p class=\"card-text mb-0\">{$text}</p>";
                    $html .= "    <div class=\"hide small text-muted border-top\"><em>Type: Action | Actor: {$actorName}</em></div>";
                    $html .= '  </div>';
                    $html .= '</div>';
                    break;

                case 'InnerThought':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="inner-thought-block bg-light border-start border-info border-3 ps-3 py-2 my-3">';
                    $html .= "  <small class=\"text-muted\">Pikiran {$charName}:</small>";
                    $html .= "  <p class=\"mb-0 fst-italic\">\"{$text}\"</p>";
                    $html .= "  <div class=\"hide small text-muted border-top mt-1 pt-1\"><em>Type: InnerThought | Character: {$charName}</em></div>";
                    $html .= '</div>';
                    break;

                case 'Emotion':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $intensity = isset($item['Intensity']) ? htmlspecialchars($item['Intensity'], ENT_QUOTES, 'UTF-8') : '-';
                    $html .= "<p class=\"emotion\">{$text}</p>";
                    $html .= "<div class=\"hide small text-muted border-top mt-1 pt-1\"><em>Type: Emotion | Character: {$charName} | Intensity: {$intensity}</em></div>";
                    break;

                default:
                    // Abaikan tipe yang tidak dikenal secara diam-diam
                    break;
            }
        }

        return $html;
    }
}
