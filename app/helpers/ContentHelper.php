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
                    $html .= "<p class=\"card-text\">{$text}</p>";
                    break;

                case 'InnerThought':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="inner-thought-block bg-body-secondary border-start border-info border-3 ps-3 py-2 my-3">';
                    $html .= "  <small class=\"text-muted\">💭 Pikiran {$charName}:</small>";
                    $html .= "  <p class=\"mb-0 fst-italic\">\"{$text}\"</p>";
                    $html .= '</div>';
                    break;

                case 'Dialogue':
                    $speakerName = isset($item['Speaker']['Name']) ? htmlspecialchars($item['Speaker']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $line = isset($item['Line']) ? htmlspecialchars($item['Line'], ENT_QUOTES, 'UTF-8') : '';
                    $tone = isset($item['Tone']) ? htmlspecialchars($item['Tone'], ENT_QUOTES, 'UTF-8') : '';
                    $html .= '<blockquote class="blockquote my-2">';
                    $html .= "  <p class=\"mb-1\">\"{$line}\"</p>";
                    $html .= "  <footer class=\"blockquote-footer mt-1\">{$speakerName} <cite title=\"Tone\">({$tone})</cite></footer>";
                    $html .= '</blockquote>';
                    break;

                case 'Emotion':
                    $html .= "<p class=\"emotion fst-italic text-muted\">{$text}</p>";
                    break;

                case 'EnemyEncounter':
                case 'Ambush':
                case 'ImminentThreat':
                    $html .= "<p>{$text}</p>";
                    break;

                case 'UnexpectedAid':
                    $source = isset($item['Source']) ? htmlspecialchars($item['Source'], ENT_QUOTES, 'UTF-8') : 'sumber tak terduga';
                    $html .= '<div class="d-flex align-items-center my-3" role="alert">';
                    $html .= "  <div>{$text} <small class=\"text-muted\">({$source})</small></div>";
                    $html .= '</div>';
                    break;

                case 'Decision':
                case 'Strategy':
                    $charName = isset($item['Character']['Name']) ? htmlspecialchars($item['Character']['Name'], ENT_QUOTES, 'UTF-8') : 'Seseorang';
                    $html .= '<div class="decision-block bg-body-secondary border-start border-success border-3 ps-3 py-2 my-3">';
                    $html .= "  <small class=\"text-muted\">💡 Keputusan {$charName}:</small>";
                    $html .= "  <p class=\"mb-0\">{$text}</p>";
                    $html .= '</div>';
                    break;

                case 'Chase':
                    $html .= "<p>{$text}</p>";
                    break;

                case 'MysteryEvent':
                case 'MysteriousPhenomenon':
                    $html .= "<div>{$text}</div>";
                    break;

                case 'MassBattle':
                    $html .= '<div class="my-4">';
                    $html .= "<p>{$text}</p>";
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
