const menu_list = document.querySelectorAll(".tab");

//menu_list 모든 원소 (모든 메뉴탭)에 이벤트 할당하기
menu_list.forEach(element => {
    element.addEventListener('click', ()=>{
        toggleTab(element.dataset.tab);
    })    
});

function toggleTab(tabNumber){
    let content_list = document.querySelectorAll(".content");
    for(let i = 0; i<3; i++){
        if(tabNumber-1 == i){
            menu_list[i].className="tab current";
            content_list[i].className="content current";
        }
        else{
            menu_list[i].className="tab";
            content_list[i].className="content";
        }
    }
}