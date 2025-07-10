<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>블로그 게시물</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold text-primary">MyBlog</a>
            <div class="d-flex">
                <a href="/posts/new" class="btn btn-primary rounded-pill me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>
                    새 글 작성
                </a>
                <a href="/admin" class="btn btn-secondary rounded-pill">관리자</a>
            </div>
        </div>
    </header>

    <main class="flex-grow container my-5">
        <div class="text-center mb-5">
            <div class="mb-4">
                <i class="fas fa-feather-alt text-primary" style="font-size: 3rem; opacity: 0.8;"></i>
            </div>
            <h1 class="display-2 fw-light mb-3" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; letter-spacing: -0.02em;">
                <span class="fw-bold text-primary">Latest</span> 
                <span class="text-dark">Stories</span>
            </h1>
            <p class="lead text-muted fs-5 mb-4" style="font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; font-weight: 300; letter-spacing: 0.01em; max-width: 600px; margin: 0 auto;">
                Thoughts on <em>technology</em>, <em>ideas</em>, and <em>everyday life</em>
            </p>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <strong>성공!</strong> <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (empty($posts)): ?>
            <div class="text-center bg-light p-5 rounded-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-journal-x text-muted mx-auto mb-3" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.146 6.146a.5.5 0 0 1 .708 0L8 7.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 8l1.147 1.146a.5.5 0 0 1-.708.708L8 8.707l-1.146 1.147a.5.5 0 0 1-.708-.708L7.293 8 6.146 6.854a.5.5 0 0 1 0-.708z"/>
                    <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                    <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                </svg>
                <p class="text-muted fs-4 mt-2">아직 게시물이 없습니다. 첫 게시물을 작성해보세요!</p>
                <a href="/posts/new" class="btn btn-primary btn-lg rounded-pill mt-4">
                    첫 글 작성하기
                </a>
            </div>
        <?php else: ?>
            <?php if (config('App')->postListLayout === 'grid'): ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    <?php foreach ($posts as $post): ?>
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                <img src="<?= !empty($post['thumbnail']) ? '/uploads/' . esc($post['thumbnail']) : 'https://via.placeholder.com/600x400.png?text=No+Image' ?>" class="card-img-top" alt="<?= esc($post['title']) ?>">
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text text-muted small">작성일: <?= esc(date('Y년 m월 d일', strtotime($post['created_at']))) ?></p>
                                    <h5 class="card-title fw-bold">
                                        <a href="/posts/<?= esc($post['slug']) ?>" class="text-decoration-none text-dark stretched-link">
                                            <?= esc($post['title']) ?>
                                        </a>
                                    </h5>
                                    <p class="card-text text-muted flex-grow-1"><?= esc(strip_tags(mb_strimwidth($post['body'], 0, 100, '...'))) ?></p>
                                    <a href="/posts/<?= esc($post['slug']) ?>" class="btn btn-sm btn-outline-primary align-self-start">더 보기 &rarr;</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: // Default to single list layout ?>
                <ul class="list-group">
                    <?php foreach ($posts as $post): ?>
                        <li class="list-group-item mb-3 shadow-sm">
                            <div class="d-flex">
                                <img src="<?= !empty($post['thumbnail']) ? '/uploads/' . esc($post['thumbnail']) : 'https://via.placeholder.com/150x150.png?text=No+Image' ?>" alt="<?= esc($post['title']) ?>" class="me-3" style="width: 150px; height: 150px; object-fit: cover;">
                                <div class="d-flex flex-column justify-content-between">
                                    <div>
                                        <p class="text-muted small">작성일: <?= esc(date('Y년 m월 d일', strtotime($post['created_at']))) ?></p>
                                        <h5 class="fw-bold">
                                            <a href="/posts/<?= esc($post['slug']) ?>" class="text-decoration-none text-dark stretched-link">
                                                <?= esc($post['title']) ?>
                                            </a>
                                        </h5>
                                        <p class="text-muted"><?= esc(strip_tags(mb_strimwidth($post['body'], 0, 150, '...'))) ?></p>
                                    </div>
                                    <a href="/posts/<?= esc($post['slug']) ?>" class="btn btn-sm btn-outline-primary align-self-start">더 보기 &rarr;</a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p>&copy; <?= date('Y') ?> MyBlog. All rights reserved.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
