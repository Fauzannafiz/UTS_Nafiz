<?php

/**
 * @var \CodeIgniter\Pager\PagerRenderer $pager
 */

$pager->setSurroundCount(2);
?>

<!doctype html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8ce5022591.js" crossorigin="anonymous"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  </head>
</html>

<div class="btn-group btn-group-toggle" data-toggle="buttons">
	<nav aria-label="<?= lang('Pager.pageNavigation') ?>">
		<ul class="pagination">
			<?php if ($pager->hasPrevious()) : ?>
				<li>
					<a class="btn btn-dark" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
						<i class="fas fa-fast-backward fa-1x"></i>
					</a>
				</li>&nbsp;
			<?php endif ?>

			<?php foreach ($pager->links() as $link) : ?>
				<li <?= $link['active'] ? 'class="active"' : '' ?>>
					<a href="<?= $link['uri'] ?>" class="btn btn-dark">
						<?= $link['title'] ?>
					</a>
				</li>&nbsp;
			<?php endforeach ?>

			<?php if ($pager->hasNext()) : ?>
				<li>
					<a class="btn btn-dark" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
						<i class="fas fa-fast-forward fa-1x"></i>

					</a>
				</li>&nbsp;
			<?php endif ?>
		</ul>
	</nav>
</div>
