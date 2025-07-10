<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?= esc($post['title']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold text-primary">MyBlog</a>
            <div class="d-flex">
                <a href="/posts" class="btn btn-outline-secondary rounded-pill me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    목록으로
                </a>
                <a href="/admin" class="btn btn-dark rounded-pill">관리자</a>
            </div>
        </div>
    </header>

    <main class="flex-grow container my-5">
        <article class="col-lg-10 mx-auto bg-white rounded-3 shadow-lg p-4 p-md-5">
            <header class="mb-5 text-center">
                <h1 class="display-4 fw-bold mb-3"><?= esc($post['title']) ?></h1>
                <p class="text-muted fs-5">
                    작성일: <time datetime="<?= esc(date('c', strtotime($post['created_at']))) ?>"><?= esc(date('Y년 m월 d일 H:i', strtotime($post['created_at']))) ?></time>
                </p>
            </header>

            <?php if (!empty($post['thumbnail'])): ?>
                <img src="/uploads/<?= esc($post['thumbnail']) ?>" alt="<?= esc($post['title']) ?>" class="img-fluid rounded-3 mb-5 shadow">
            <?php endif; ?>

            <div class="fs-5" style="line-height: 1.8;">
                <?= nl2br(esc($post['body'])) ?>
            </div>

            <hr class="my-5">

            <div class="d-flex justify-content-center gap-3">
                <a href="/posts/<?= esc($post['slug']) ?>/edit" class="btn btn-outline-primary btn-lg rounded-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                    수정
                </a>
                <form method="post" action="/posts/<?= esc($post['slug']) ?>" onsubmit="return confirm('정말로 이 게시물을 삭제하시겠습니까?');">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-outline-danger btn-lg rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill me-2" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                        </svg>
                        삭제
                    </button>
                </form>
            </div>
        </article>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> MyBlog. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</html>
