<?php
function PokazPodstrone(PDO $pdo, string $alias): ?array
{
    $zapytanie = $pdo->prepare(
        'SELECT id, page_title, page_content FROM page_list WHERE alias = :alias AND status = 1 LIMIT 1'
    );
    $zapytanie->execute([':alias' => $alias]);
    $rekord = $zapytanie->fetch(PDO::FETCH_ASSOC);

    return $rekord === false ? null : $rekord;
}