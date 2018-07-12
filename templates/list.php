<?php
/** @var \MistapeValidator\Mistape[] $mistapes */
?>

<div class="wrap">
    <h2>Mistape</h2>
    <table class="wp-list-table widefat fixed striped ">
        <thead>
        <tr>
            <th style="width: 5%">ID</th>
            <th style="width: 20%">Article</th>
            <th>Avant</th>
            <th>Après</th>
            <th style="width: 15%">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($mistapes as $mistape): ?>
            <?php
            $corrector = new \MistapeValidator\MistapeCorrector($mistape);
            $corrector->canAutoFix();
            ?>
            <tr>
                <td><?= $mistape->getID() ?></td>
                <td><?php edit_post_link($mistape->getPost()->post_title, null, null, $mistape->getPostId()) ?></td>
                <td><?= $corrector->renderContext() ?></td>
                <td><?= $corrector->canAutoFix() ? $corrector->renderAutoFix() : 'Correction impossible' ?></td>
                <td>
                    <button
                            class="button button-primary mistape"
                            <?php if (!$corrector->canAutoFix()): ?>disabled="disabled"<?php endif; ?>
                            data-action='mistape_accept'
                            data-mistape-id="<?= $mistape->getID() ?>">Accepter
                    </button>
                    <button
                            class="button button-cancel mistape"
                            data-action='mistape_reject'
                            data-mistape-id="<?= $mistape->getID() ?>">Rejeter
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>