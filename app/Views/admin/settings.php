<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>디자인 설정</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold text-primary">MyBlog</a>
            <nav>
                <a href="/admin" class="btn btn-outline-secondary rounded-pill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    관리자 홈
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-grow-1 container my-5">
        <div class="col-lg-8 mx-auto bg-white rounded-3 shadow-lg p-5">
            <h2 class="display-5 fw-bold text-center mb-5">디자인 설정</h2>

            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>성공!</strong> <?= session()->getFlashdata('message') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="/admin/saveSettings" method="post">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label for="post_list_layout" class="form-label fs-5">게시물 목록 레이아웃</label>
                    <select name="post_list_layout" id="post_list_layout" class="form-select form-select-lg">
                        <?php foreach ($layouts as $key => $name) : ?>
                            <option value="<?= esc($key) ?>" <?= ($key === $currentLayout) ? 'selected' : '' ?>>
                                <?= esc($name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text">블로그 홈에서 게시물이 표시되는 방식을 선택합니다.</div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill me-2" viewBox="0 0 16 16">
                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c.366 0 .708.158 1 .418V1.5zM9 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3zM5.5 10a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        </svg>
                        설정 저장
                    </button>
                </div>
            </form>
        </div>
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
