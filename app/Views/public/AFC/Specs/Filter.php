<button class="btn showFilter">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
        <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
        <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
    </svg>
</button>

<div class="specs-filter">
    <nav class="px-5">
        <a href="/" class="btn btn-main">Вернуться на главную</a>
    </nav>

    <hr>
    <h3 class="px-5 py-2 text-center">Приоритет</h3>
    <div class="container px-5">
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="prAll" data-class="pr-all">
            <label class="form-check-label" for="prAll">
                Суммарно
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="pr1" data-class="pr-1" checked>
            <label class="form-check-label" for="pr1">
                Приоритет 1
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="pr2" data-class="pr-2">
            <label class="form-check-label" for="pr2">
                Приоритет 2
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="pr3" data-class="pr-3">
            <label class="form-check-label" for="pr3">
                Приоритет 3
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="pr4" data-class="pr-4">
            <label class="form-check-label" for="pr4">
                Приоритет 4
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="pr5" data-class="pr-5">
            <label class="form-check-label" for="pr5">
                Приоритет 5
            </label>
        </div>
        <div class="form-check py-1">
            <input class="form-check-input" type="radio" name="change-priority" id="prOther" data-class="pr-other">
            <label class="form-check-label" for="prOther">
                Остальные
            </label>
        </div>
    </div>

    <hr>
    <h3 class="px-5 py-2 text-center">Список</h3>
        <div class="px-5 mb-3">
            <a href="#" class="btn btn-main w-100 btnSpecShowAll">Развернуть все</a>
        </div>
        <div class="px-5">
            <a href="#" class="btn btn-main w-100 btnSpecHideAll">Свернуть все</a>
        </div>

</div>
