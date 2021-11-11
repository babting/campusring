var chatManager = new function(){

    var idle 		= true;
    var interval	= 500;
    var xmlHttp		= new XMLHttpRequest();
    var finalDate	= '';
    // Ajax Setting
    xmlHttp.onreadystatechange = function()
    {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
        {
            // JSON 포맷으로 Parsing
            res = JSON.parse(xmlHttp.responseText);
            finalDate = res.date;

            // 채팅내용 보여주기
            chatManager.show(res.data);

            // 중복실행 방지 플래그 OFF
            idle = true;
        }
    }

    // 채팅내용 가져오기
    this.proc = function()
    {
        let boardProc   = $('#board').val();
        // console.log(boardProc);
        // 중복실행 방지 플래그가 ON이면 실행하지 않음
        if(!idle)
        {
            return false;
        }

        // 중복실행 방지 플래그 ON
        idle = false;
        // Ajax 통신
        xmlHttp.open("GET", "proc.php?date=" + encodeURIComponent(finalDate) + "&board=" + encodeURIComponent(boardProc), true);
        xmlHttp.send();
    }

    // 채팅내용 보여주기
    this.show = function(data)
    {
        var chat_box = document.getElementById('list');
        var chatScreen = document.getElementsByClassName('chat_screen');
        var firstDiv, chat_profile, chat_size, chat_main_left;
        var chatmsg;
        var imageBk;

        let myid   = $('#name').val();

        // 채팅내용 추가
        for(var i=0; i<data.length; i++)
        {
            //첫번째 div
            firstDiv = document.createElement('div');

            imageBk = new Image();
            //내가 보낸 메시지일경우
            if (myid == data[i].name){
                firstDiv.classList.add('chat_sort');
                imageBk.src = data[i].myPhoto
            } else{
                //상대가 보낸 메시지일경우
                firstDiv.classList.add('chat_msg_sort');
                imageBk.src = data[i].youPhoto
            }
            chat_box.appendChild(firstDiv);

            //두번째 div
            chat_profile = document.createElement('div');
            chat_size = document.createElement('div');
            chat_profile.classList.add('chat_profile');
            chat_size.classList.add('chat_size');
            firstDiv.appendChild(chat_profile);
            firstDiv.appendChild(chat_size);

            chat_profile.appendChild(imageBk);

            //chat_size ->
            chat_main_left = document.createElement("div");
            chat_main_left.classList.add('chat_main_left');
            chat_size.appendChild(chat_main_left);

            //채팅내용
            chatmsg = document.createElement('p');
            // chatmsg.appendChild(document.creareTextNode(data[i].msg));
            chatmsg.appendChild(document.createTextNode(data[i].msg));
            chat_main_left.appendChild(chatmsg);

        }

        // 가장 아래로 스크롤
        //document.body.scrollTop = document.body.scrollHeight;

    }

    // 채팅내용 작성하기
    this.write = function(frm)
    {
        var xmlHttpWrite	= new XMLHttpRequest();
        var name			= frm.name.value;
        var msg				= frm.msg.value;
        var board			= frm.board.value;
        var param			= [];

        // 이름이나 내용이 입력되지 않았다면 실행하지 않음
        if(name.length == 0 || msg.length == 0)
        {
            return false;
        }

        // POST Parameter 구축
        param.push("name=" + encodeURIComponent(name));
        param.push("msg=" + encodeURIComponent(msg));
        param.push("board=" + encodeURIComponent(board));

        // Ajax 통신
        xmlHttpWrite.open("POST", "write.php", true);
        xmlHttpWrite.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlHttpWrite.send(param.join('&'));

        // 내용 입력란 비우기
        frm.msg.value = '';

        document.body.scrollTop = document.body.scrollHeight;
        // 채팅내용 갱신
        document.documentElement.scrollTop = document.body.scrollHeight;
        chatManager.proc();
    }

    // interval에서 지정한 시간 후에 실행
    setInterval(this.proc, interval);
}