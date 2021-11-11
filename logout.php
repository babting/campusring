<?php
session_start();
session_destroy();
?>
<!-- 우선 현재 경로에서 login.php를 인식하지 못하는 관계로 script로 작성해서 돌렸는데 -->
<!-- 로그아웃하면 그냥 메인으로 보내는 것도 나쁘지 않을거 같아요 -->
<!-- 로그인 페이지에 뒤로가기 버튼이 있는데 이 코드 처럼 logout.php에서 login.php로 보낸 후에 login.php에서 뒤로가기 버튼을 누르면 -->
<!-- 다시 logout.php로 가게되어서요.-->
<!-- 그리고 뒤로가기 버튼에 대해서는 hover시 커서 포인터 되도록 설정해두었어요. style.css 마지막 라인 확인하셔서 아닌거 같으면 빼시고 사용하시면 -->
<!-- 될거 같아요~ -->
<script>
    location.href='./index.php';
</script>
