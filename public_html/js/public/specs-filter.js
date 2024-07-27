document.addEventListener("DOMContentLoaded",()=>{
    let checkList= document.querySelectorAll(".specs-filter input[name=change-priority]");

    if(checkList.length)
        checkList.forEach(el=>{
            el.addEventListener("change",()=>{

                document.querySelectorAll(".pr.active")
                    .forEach(pr=>{
                        pr.classList.remove("active");
                    });

                document.querySelectorAll(".pr."+el.getAttribute("data-class"))
                    .forEach(pr=>{
                        pr.classList.add("active");
                    });
            });
        });

    let filterBox       = document.querySelector(".specs-filter");
    let btnShowFilter   = document.querySelector(".btn.showFilter");

    btnShowFilter.addEventListener("click",()=>{
        if(btnShowFilter.classList.contains("active")){
            btnShowFilter.classList.remove("active");
            filterBox.classList.remove("active");
        }
        else{
            btnShowFilter.classList.add("active");
            filterBox.classList.add("active");
        }
    });

    let edLevelsHead= document.querySelectorAll(".specs-list h2 button");
    let edLevelsBody= document.querySelectorAll(".specs-list .accordion-collapse");

    document.querySelector(".btnSpecHideAll")
        .addEventListener("click",(e)=>{
            edLevelsHead.forEach(el=>{
                el.classList.add("collapsed");
            });
            edLevelsBody.forEach(el=>{
                el.classList.remove("show");
            });
            e.preventDefault();
        });

    document.querySelector(".btnSpecShowAll")
        .addEventListener("click",(e)=>{
            edLevelsHead.forEach(el=>{
                el.classList.remove("collapsed");
            });
            edLevelsBody.forEach(el=>{
                el.classList.add("show");
            });
            e.preventDefault();
        });


});

document.addEventListener("keydown",(evt)=>{
    if(evt.key === "Escape") {
        document.querySelector(".specs-filter").classList.remove("active");
        document.querySelector(".btn.showFilter").classList.remove("active");
    }


});