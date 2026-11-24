<?php
$project = get_project_by_id(get_the_ID());

// -> the other projects for the thumbnails (max. 3)
$other_ids = get_posts([
    'post_type' => 'project',
    'posts_per_page' => 3,
    'post__not_in' => [get_the_ID()],
    'fields' => 'ids',
]);
$others = array_map('get_project_by_id', $other_ids);
?>

<main data-page="project">

    <section class="project-stage">

        <div class="project-info">
            <h1 class="project-row project-title"><?= $project['title'] ?></h1>

            <?php if ($project['client']) : ?>
                <p class="project-row project-client"><?= $project['client'] ?></p>
            <?php endif; ?>

            <?php if ($project['date']) : ?>
                <p class="project-row project-date"><?= $project['date'] ?></p>
            <?php endif; ?>

            <?php if ($project['credits']) : ?>
                <details class="project-credits">
                    <summary class="project-row project-credits-toggle">Credits</summary>
                    <ul class="project-credits-list">
                        <?php foreach ($project['credits'] as $credit) : ?>
                            <li class="project-credit">
                                <span class="project-credit-role"><?= $credit['role'] ?></span>
                                <span class="project-credit-name"><?= $credit['name'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </details>
            <?php endif; ?>
        </div>

        <div class="project-video">
            <?php if ($project['vimeo_id']) : ?>
                <iframe
                    class="project-video-player"
                    src="https://player.vimeo.com/video/<?= $project['vimeo_id'] ?>"
                    title="<?= $project['title'] ?>"
                    allow="autoplay; fullscreen; picture-in-picture"
                    allowfullscreen>
                </iframe>
            <?php endif; ?>
        </div>

    </section>

    <section class="project-thumbnails">
        <?php for ($i = 0; $i < 3; $i++) : ?>
            <?php $other = $others[$i] ?? null; ?>
            <?php if ($other && !empty($other['thumbnail']['src'])) : ?>
                <a class="project-thumbnail"
                   href="<?= $other['link'] ?>"
                   data-vimeo-id="<?= $other['vimeo_id'] ?>">
                    <img class="project-thumbnail-image"
                         src="<?= $other['thumbnail']['src'] ?>"
                         alt="<?= $other['thumbnail']['alt'] ?>">
                </a>
            <?php else : ?>
                <div class="project-thumbnail project-thumbnail--empty"></div>
            <?php endif; ?>
        <?php endfor; ?>
    </section>

</main>