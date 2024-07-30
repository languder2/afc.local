document.addEventListener("DOMContentLoaded",()=>{
    let faculties= document.querySelectorAll(".faculties .faculty-btn");

    faculties.forEach((el)=>{

        el.addEventListener("click",(e)=>{

            if(el.classList.contains("active")) return false;

            faculties.forEach((navEl)=>{
                navEl.classList.remove("active");
            });

            el.classList.add("active");

            let fid= el.getAttribute("data-fid");

            let facultiesContent    = document.querySelector(".faculties-content");

            facultiesContent.style.height = facultiesContent.offsetHeight + "px";

            facultiesContent.offsetHeight;

            facultiesContent.classList.add("hide");


            let timer= setTimeout(()=>{
                window.clearTimeout(timer);
                let visible= document.querySelectorAll(".faculties .faculty.show");

                visible.forEach(el=>{
                    el.classList.remove("show");
                });

                let toShow= document.querySelector(".faculties .faculty[data-fid='"+fid+"']");
                toShow.classList.add("show");

                facultiesContent.style.height = toShow.scrollHeight + 44 + "px";
                facultiesContent.classList.remove("hide");
                setTimeout(()=>{
                    facultiesContent.style.height = "auto";
                },300);
            },500);
        });
    });

    let levels= document.querySelectorAll(".faculties .levelTitle");

    levels.forEach(el=>{
        el.addEventListener("click",()=>{
            let facultyLevel= el.closest(".faculty-level");
            facultyLevel.classList.toggle("show");
        });
    });

});
