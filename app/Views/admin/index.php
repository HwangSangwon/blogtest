<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 페이지</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold text-primary">MyBlog</a>
            <nav>
                <a href="/posts" class="btn btn-outline-primary rounded-pill">
                    블로그 홈
                </a>
            </nav>
        </div>
    </header>

    <main class="flex-grow-1 container my-5">
        <div class="col-lg-10 mx-auto bg-white rounded-3 shadow-lg p-5">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold">관리자 대시보드</h1>
                <p class="lead text-muted mt-2">블로그의 모든 것을 관리하세요.</p>
            </div>

            <div class="row row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <a href="/admin/settings" class="card card-body text-decoration-none h-100 shadow-sm border-primary border-2">
                        <h3 class="card-title h5 fw-bold text-primary mb-2">디자인 설정</h3>
                        <p class="card-text text-muted">블로그의 레이아웃과 디자인을 변경합니다.</p>
                    </a>
                </div>
                <div class="col">
                    <a href="/admin/posts" class="card card-body text-decoration-none h-100 shadow-sm">
                        <h3 class="card-title h5 fw-bold text-dark mb-2">게시물 관리</h3>
                        <p class="card-text text-muted">게시물을 강제 삭제합니다.</p>
                    </a>
                </div>
                <!-- 추가 관리 메뉴가 필요하다면 여기에 추가 -->
            </div>
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
