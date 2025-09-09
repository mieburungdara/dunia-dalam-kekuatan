<?php

class ContentHelper
{
    public static function render(array $contents): string
    {
        $html = '';

        foreach ($contents as $item) {
            $text = isset($item['Text']) ? htmlspecialchars($item['Text'], ENT_QUOTES, 'UTF-8') : '';
            $type = $item['Type'] ?? 'unknown';

            switch ($type) {
                case 'Exposition':
                case 'Description':
                    $html .= "<p>{$text}</p>";
                    break;

                case 'Action':
                case 'BattleMove':
                    $actorName = isset($item['Actor']['Name']) ? htmlspecialchars($item['Actor']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= "<p class=\"fst-italic text-muted\">{$text}</p>";
                    break;

                case 'InnerThought':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="inner-thought-block bg-light border-start border-info border-3 ps-3 py-2 my-3">';
                    $html .= "  <small class=\"text-muted\">Pikiran {$charName}:</small>";
                    $html .= "  <p class=\"mb-0 fst-italic\">\"{$text}\"</p>";
                    $html .= '</div>';
                    break;

                case 'Dialogue':
                    $speakerName = isset($item['Speaker']['Name']) ? htmlspecialchars($item['Speaker']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $line = isset($item['Line']) ? htmlspecialchars($item['Line'], ENT_QUOTES, 'UTF-8') : '';
                    $tone = isset($item['Tone']) ? htmlspecialchars($item['Tone'], ENT_QUOTES, 'UTF-8') : '';
                    $html .= '<blockquote class="blockquote my-2">';
                    $html .= "  <p class=\"mb-1\">\"{$line}\"</p>";
                    $html .= "  <footer class=\"blockquote-footer\">{$speakerName} <cite title=\"Tone\">({$tone})</cite></footer>";
                    $html .= '</blockquote>';
                    break;

                case 'Emotion':
                    $html .= "<p class=\"fst-italic text-muted\">{$text}</p>";
                    break;

                case 'EnemyEncounter':
                case 'Ambush':
                case 'ImminentThreat':
                    $html .= "<p class=\"fst-italic text-muted\">{$text}</p>";
                    break;

                case 'UnexpectedAid':
                    $source = isset($item['Source']) ? htmlspecialchars($item['Source'], ENT_QUOTES, 'UTF-8') : 'sumber tak terduga';
                    $html .= "<div class=\"alert alert-success my-3\"><strong>Bantuan Tak Terduga!</strong> ({$source}) - {$text}</div>";
                    break;

                case 'Decision':
                case 'Strategy':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="decision-block bg-light border-start border-success border-3 ps-3 py-2 my-3">';
                    $html .= "  <small class=\"text-muted\">Keputusan / Strategi oleh {$charName}:</small>";
                    $html .= "  <p class=\"mb-0\">{$text}</p>";
                    $html .= '</div>';
                    break;

                case 'Chase':
                    $html .= "<p class=\"chase-sequence fst-italic text-muted\">{$text}</p>";
                    break;

                case 'MysteryEvent':
                case 'MysteriousPhenomenon':
                    $html .= "<div class=\"alert alert-secondary my-3\">{$text}</div>";
                    break;

                case 'MassBattle':
                    $html .= '<div class="card my-4 text-white bg-dark">';
                    $html .= '  <div class="card-header">Pertempuran Besar</div>';
                    $html .= "  <div class=\"card-body\"><p class=\"card-text\">{$text}</p></div>";
                    $html .= '</div>';
                    break;

                case 'Foreshadowing':
                    $html .= "<p class=\"foreshadowing text-muted fst-italic\">{$text}</p>";
                    break;

                default:
                    if (!empty($text)) {
                        $html .= "<p>{$text}</p>";
                    }
                    break;
            }
            
            // Add dev info block for all types
            $dev_info = json_encode($item, JSON_PRETTY_PRINT);
            $html .= "<div class=\"hide small text-muted border-top mt-1 pt-1\"><pre><code>{$dev_info}</code></pre></div>\n";
        }

        return $html;
    }
}