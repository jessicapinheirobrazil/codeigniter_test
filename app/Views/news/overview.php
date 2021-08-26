<script>

    function confirme() {
        if (!confirm("Are you sure?")) {
            return false;
        }

        return true;
    }

</script>

<h2> News Archive</h2>

<a href="/news/create" class="btn btn-primary mb-3">Create new</a>

<table class="table table-light">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Action</td>
        </tr>
    </thead>

    <tbody>
    <?php if (!empty($news) && is_array($news)): ?>
        <?php foreach ($news as $news_item) : ?>

        <tr>
            <td>
                <a href="<?php echo "/news/view/".$news_item['id'] ?>">
                <?php echo $news_item['title'] ?>
                </a>
            </td>

            <td>
                <a href="/news/edit/<?php echo $news_item['id']?>" >
                Edit
                </a>
            </td>

            <td>
                <a href="/news/delete/<?php echo $news_item['id']?>" onclick="return confirme()">
                Delete
                </a>
            </td>
        </tr>

        <?php endforeach; ?>
    <?php else : ?>

        <tr>
            <td colspan="2">Nothing found here.</td>
        </tr>

    <?php endif; ?>
    </tbody>
</table>