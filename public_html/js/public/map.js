document.addEventListener("DOMContentLoaded",()=>{
    let list= document.querySelectorAll("path.region.active");

    if(list.length){
        let current = document.querySelector(".show-info .current");
        let base    = document.querySelector(".show-info .base")
        list.forEach(el=>{
           el.addEventListener("mouseover",()=>{
               current.textContent =
                   el.getAttribute("data-title")
                   + ": " +
                   el.getAttribute("data-count")
               ;
               current.classList.remove("d-none");
               base.classList.add("d-none");

               console.log(el.getAttribute("data-title"));
           });

           el.addEventListener("mouseout",()=>{
               current  .classList.add("d-none");
               base     .classList.remove("d-none");

               console.log(el.getAttribute("data-title"));
           });
        });
    }
});
