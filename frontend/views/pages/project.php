<?php
$project = get_project_by_id(get_the_ID());
js_log($project);

// -> alle anderen Projekte für die Vorschaubilder
$other_ids = get_posts([
    'post_type' => 'project',
    'posts_per_page' => -1,
    'post__not_in' => [get_the_ID()],
    'fields' => 'ids',
]);
$others = array_map('get_project_by_id', $other_ids);
?>

<main data-page="project">

    <section class="project-stage">

        <div class="project-info">
            <h1 class="project-title"><?= $project['title'] ?></h1>

            <?php if ($project['client']) : ?>
                <p class="project-client"><?= $project['client'] ?></p>
            <?php endif; ?>

            <?php if ($project['date']) : ?>
                <p class="project-date"><?= $project['date'] ?></p>
            <?php endif; ?>

            <?php if ($project['description']) : ?>
                <div class="project-description">
                    <?= wpautop($project['description']) ?>
                </div>
            <?php endif; ?>

            <?php if ($project['credits']) : ?>
                <details class="project-credits">
                    <summary>Credits</summary>
                    <ul>
                        <?php foreach ($project['credits'] as $credit) : ?>
                            <li>
                                <span class="credit-role"><?= $credit['role'] ?></span>
                                <span class="credit-name"><?= $credit['name'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </details>
            <?php endif; ?>
        </div>

        <div class="project-video">
            <?php if ($project['vimeo_id']) : ?>
                <iframe
                    src="https://player.vimeo.com/video/<?= $project['vimeo_id'] ?>"
                    title="<?= $project['title'] ?>"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen>
                </iframe>
            <?php endif; ?>
        </div>

    </section>

    <?php if ($others) : ?>
        <section class="project-thumbnails">
            <?php foreach ($others as $other) : ?>
                <a class="project-thumbnail"
                   href="<?= $other['link'] ?>"
                   data-vimeo-id="<?= $other['vimeo_id'] ?>">
                    <img src="<?= $other['thumbnail']['src'] ?>" alt="<?= $other['thumbnail']['alt'] ?>">
                </a>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

</main>