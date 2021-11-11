<?php
    /**
     * AJAX CALL 성공 데이터 FORMAT
     * @param $data (default = null)
     * @return json format
     * 로그인 성공같은 경우는 굳이 data를 내려보낼 필요 없이 해당 비즈니스로직이 정상적으로 이루어졌는지 확인만 하면 되므로 data는 null로 정의하고, result를 true로 정의
     * 데이터를 내려보낼 것이 필요하다면, $data에 알맞은 데이터 (예: $row) 를 넣어서 return
     */
    function jsonSuccess($data = null) {
        return json_encode(array("result" => true, "errorReason" => "", "code" => 200, "data" => $data));
    }

    /**
     * AJAX CALL 실패 데이터 FORMAT
     * @param string $message
     * @param int $code
     * @return json format
     * 실패한 경우이므로 내려줄 data는 null로 고정 셋팅한 후, 변경될 데이터 (code, message)를 동적으로 받아서 내려줌.
     */
    function jsonFailure($message = "internal server error", $code = 500, $exception = null) {
        return json_encode(array("result" => false, "errorReason" => $message, "code" => $code, "data" => null, "exception" => $exception));
    }
?>