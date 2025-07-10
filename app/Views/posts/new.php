<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>새 게시물 작성</title>
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
        <div class="col-lg-8 mx-auto bg-white rounded-3 shadow-lg p-5">
            <h2 class="display-5 fw-bold text-center mb-5">새로운 생각 기록하기</h2>

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

            <form action="/posts" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-4">
                    <label for="title" class="form-label fs-5">제목</label>
                    <input type="text" id="title" name="title" value="<?= old('title') ?>" required class="form-control form-control-lg" placeholder="멋진 제목을 입력하세요">
                </div>
                <div class="mb-4">
                    <label for="body" class="form-label fs-5">내용</label>
                    <textarea id="body" name="body" required class="form-control form-control-lg" style="height: 200px" placeholder="어떤 이야기를 공유하고 싶으신가요?"><?= old('body') ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="thumbnail" class="form-label fs-5">대표 이미지</label>
                    <input type="file" id="thumbnail" name="thumbnail" class="form-control form-control-lg">
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                    <a href="/posts" class="btn btn-secondary btn-lg rounded-pill">취소</a>
                    <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                        게시하기
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
