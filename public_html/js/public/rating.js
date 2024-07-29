document.addEventListener("DOMContentLoaded",()=>{
    let list= document.querySelectorAll(".rating-faculty-btn");

    if(list.length > 0){

        list.forEach((el)=>{
            el.addEventListener("click",()=>{

                if(el.classList.contains("active")) return false;

                list.forEach((navEl)=>{
                    navEl.classList.remove("active");
                });

                el.classList.add("active");

                let fid= el.getAttribute("data-fid");

                console.log(fid);


            });
        });
    }

});
