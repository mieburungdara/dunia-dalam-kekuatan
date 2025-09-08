<?php
function renderStoryContent($storyData) {
    echo '<div class="container">';
    echo '<h1>' . htmlspecialchars($storyData['Meta']['Title']) . '</h1>';
    echo '<p><strong>Author:</strong> ' . htmlspecialchars($storyData['Meta']['Author']) . '</p>';
    echo '<p><strong>Genre:</strong> ' . implode(', ', $storyData['Meta']['Genre']) . '</p>';
    echo '<p><strong>World:</strong> ' . htmlspecialchars($storyData['Meta']['World']) . '</p>';

    foreach ($storyData['Chapters'] as $chapter) {
        echo '<h2>Chapter ' . htmlspecialchars($chapter['ChapterNumber']) . ': ' . htmlspecialchars($chapter['Title']) . '</h2>';
        echo '<p><em>Summary:</em> ' . htmlspecialchars($chapter['Summary']) . '</p>';

        foreach ($chapter['Scenes'] as $scene) {
            echo '<h3>Scene ' . htmlspecialchars($scene['SceneNumber']) . '</h3>';
            echo '<p><strong>Location:</strong> ' . htmlspecialchars($scene['Location']['Name']) . '</p>';
            echo '<p><strong>Time:</strong> ' . htmlspecialchars($scene['Time']) . '</p>';

            foreach ($scene['Contents'] as $content) {
                switch ($content['Type']) {
                    case 'Exposition':
                    case 'Atmosphere':
                    case 'Description':
                    case 'Action':
                    case 'InnerThought':
                    case 'Emotion':
                    case 'Clue':
                    case 'Conflict':
                    case 'Decision':
                    case 'Transition':
                    case 'BattleMove':
                    case 'Vision':
                    case 'NarratorNote':
                    case 'Travelogue':
                    case 'Flashback':
                    case 'Foreshadowing':
                    case 'Symbolism':
                    case 'Prophecy':
                    case 'Dream':
                    case 'Hallucination':
                    case 'ItemDiscovery':
                    case 'MysteryEvent':
                    case 'Training':
                    case 'Strategy':
                    case 'Debate':
                    case 'Reveal':
                    case 'Alliance':
                    case 'Celebration':
                    case 'LetterOrMessage':
                    case 'Rumor':
                    case 'MoralReflection':
                    case 'ComicRelief':
                    case 'Injury':
                    case 'Recovery':
                    case 'RelationshipShift':
                    case 'Negotiation':
                    case 'FoilMoment':
                    case 'Omens':
                    case 'Ambush':
                    case 'Chase':
                    case 'Hideout':
                    case 'Discovery':
                    case 'Exposure':
                    case 'Sabotage':
                    case 'Collaboration':
                    case 'RitualSuccess':
                    case 'Overheard':
                    case 'Coincidence':
                    case 'Lost':
                    case 'Guidance':
                    case 'Conspiracy':
                    case 'Duel':
                    case 'MassBattle':
                    case 'Infiltration':
                    case 'Sabda':
                    case 'Haunting':
                    case 'Collapse':
                    case 'Exile':
                    case 'Reconciliation':
                    case 'WarningIgnored':
                    case 'IdentityReveal':
                    case 'SwitchSides':
                    case 'DivineIntervention':
                    case 'SuddenSilence':
                    case 'Echo':
                    case 'ForeshadowedFailure':
                    case 'Misdirection':
                    case 'SacredPlace':
                    case 'TrapActivation':
                    case 'SacrificeDecision':
                    case 'MoralDilemma':
                    case 'Eavesdrop':
                    case 'RiteOfPassage':
                    case 'ShadowMovement':
                    case 'Illusion':
                    case 'MemoryTrigger':
                    case 'CulturalRitual':
                    case 'HiddenMotivation':
                    case 'CriticalMistake':
                    case 'SecretMeeting':
                    case 'NaturalDisaster':
                    case 'UnexpectedAlliance':
                    case 'HeroicAct':
                    case 'FailedAttempt':
                    case 'DividedGroup':
                    case 'FalseFriend':
                    case 'PowerSurge':
                    case 'RogueDecision':
                    case 'HauntedMemory':
                    case 'MysteriousGuide':
                    case 'PropheticDream':
                    case 'CriticalChoice':
                    case 'SecretMessage':
                    case 'UnseenWatcher':
                    case 'TwistOfFate':
                    case 'HeroicFailure':
                    case 'UnexpectedCompanion':
                    case 'CulturalConflict':
                    case 'LegendRevealed':
                    case 'UnexpectedEvent':
                    case 'MoralCorruption':
                    case 'SecretAgenda':
                    case 'PowerStruggle':
                    case 'ClimacticShowdown':
                    case 'SecretWeapon':
                    case 'ImminentThreat':
                    case 'HiddenTrap':
                    case 'SuddenLoss':
                    case 'RevealedWeakness':
                    case 'UnexpectedTwist':
                    case 'SurvivalChallenge':
                    case 'BetrayalConsequence':
                    case 'UnintendedConsequence':
                    case 'LegendaryEncounter':
                    case 'RomanticTension':
                    case 'Jealousy':
                    case 'SiblingConflict':
                    case 'AssassinationAttempt':
                    case 'UnexpectedComplication':
                    case 'MysteriousPhenomenon':
                    case 'PsychologicalManipulation':
                    case 'DesperateDecision':
                    case 'UnlikelySurvival':
                    case 'UnexpectedDeath':
                    case 'MysticalEncounter':
                    case 'RevelationMoment':
                    case 'SuddenAmbush':
                    case 'UnexpectedMentor':
                    case 'HiddenDanger':
                    case 'KnowledgeDiscovery':
                    case 'Ritual':
                    case 'TrialOrChallenge':
                    case 'Betrayal':
                    case 'ArtifactDiscovery':
                    case 'SecretIdentity':
                    case 'HiddenPath':
                    case 'UnexpectedAid':
                    case 'EnemyEncounter':
                    case 'TimeConstraint':
                    case 'EmotionalArc':
                    case 'SecretAlliance':
                    case 'Sacrifice':
                    case 'UnexpectedTransformation':
                    case 'PoliticalIntrigue':
                    case 'ForbiddenLove':
                    case 'TimeSkip':
                        echo '<p><strong>' . htmlspecialchars($content['Type']) . ':</strong> ' . htmlspecialchars($content['Text']) . '</p>';
                        break;
                    case 'Dialogue':
                        echo '<p><strong>' . htmlspecialchars($content['Speaker']['Name']) . ':</strong> ' . htmlspecialchars($content['Line']) . '</p>';
                        break;
                    case 'ItemDiscovery':
                        echo '<p><strong>' . htmlspecialchars($content['Type']) . ':</strong> ' . htmlspecialchars($content['Text']) . ' (Item: ' . htmlspecialchars($content['Item']['Name']) . ')</p>';
                        break;
                    // Add more cases for other specific types if needed
                    default:
                        echo '<p><strong>' . htmlspecialchars($content['Type']) . ':</strong> ' . htmlspecialchars(json_encode($content)) . '</p>';
                        break;
                }
            }
            if (isset($scene['Notes'])) {
                echo '<p><em>Notes:</em> ' . htmlspecialchars($scene['Notes']) . '</p>';
            }
        }
    }
    echo '</div>';
}
?>