<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>게시물 수정</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold text-primary">MyBlog</a>
            <div class="d-flex">
                <a href="/posts/<?= esc($post['slug']) ?>" class="btn btn-outline-secondary rounded-pill me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle-fill me-1" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                    게시물로 돌아가기
                </a>
                <a href="/admin" class="btn btn-dark rounded-pill">관리자</a>
            </div>
        </div>
    </header>

    <main class="flex-grow container my-5">
        <div class="col-lg-8 mx-auto bg-white rounded-3 shadow-lg p-5">
            <h2 class="display-5 fw-bold text-center mb-5">게시물 수정하기</h2>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <strong>오류가 발생했습니다</strong>
                    <ul class="mb-0 mt-2">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="/posts/<?= esc($post['slug']) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">
                <div class="mb-4">
                    <label for="title" class="form-label fs-5">제목</label>
                    <input type="text" id="title" name="title" value="<?= old('title', $post['title']) ?>" required class="form-control form-control-lg">
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label fs-5">내용</label>
                    <textarea id="body" name="body" required class="form-control form-control-lg" style="height: 200px"><?= old('body', $post['body']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="thumbnail" class="form-label fs-5">대표 이미지</label>
                    <input type="file" id="thumbnail" name="thumbnail" class="form-control form-control-lg">
                    <?php if (!empty($post['thumbnail'])): ?>
                        <div class="mt-3">
                            <p class="mb-2">현재 이미지:</p>
                            <img src="/uploads/<?= esc($post['thumbnail']) ?>" alt="<?= esc($post['title']) ?>" class="img-fluid rounded" style="max-height: 200px;">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                    <a href="/posts/<?= esc($post['slug']) ?>" class="btn btn-secondary btn-lg rounded-pill">취소</a>
                    <button type="submit" class="btn btn-success btn-lg rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                        업데이트
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
