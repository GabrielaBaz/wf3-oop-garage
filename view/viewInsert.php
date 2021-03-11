<?php $title = 'El Taller Home' ?>

<?php ob_start() ?>
<section class="container">
    <form action="index.php?action=insert" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control mb-3" id="name" name="name">

            <label for="brand" class="form-label">Brand</label>
            <input type="text" class="form-control mb-3" id="brand" name="brand">

            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control mb-3" id="price" name="price">

            <input class="form-control mb-3" type="file" name="photo" id="photo">

            <label for="description" class="form-label">Description</label>
            <textarea type="text" class="form-control mb-3" id="description" name="description"></textarea>

            <button class="btn btn-warning mt-3" type="submit">Add</button>

        </div>
        <a href="index.php?action=carList" class="btn btn-primary">Show me the cars</a>
    </form>
</section>

<?php $content = ob_get_clean() ?>

<?php require('view/template.php') ?>