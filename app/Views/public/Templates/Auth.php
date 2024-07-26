<form
        action="<?=base_url("auth")?>"
        method="post"
        class="mx-auto mw-450 bg-white rounded-4"
>
    <h3 class="m-0 p-3 text-center bg-primary rounded-top-4 bg-darkred text-white mt-center">
        Авторизация
    </h3>
    <div class="form-body m-0 px-3 pb-4 pt-1">
        <?php if(!empty($message)):?>
            <div>
                <?=$message?>
            </div>
        <?php endif;?>
        <div class="s-input">
            <input
                    type        = "password"
                    name        = "pass"
                    id          = "auth"
                    class       = "form-control"
                    placeholder = ""
                    value       = ""
                    required
            >
            <label class="" for="auth">
                пароль
            </label>
        </div>
        <div class="px-3">
            <button class="btn btn-red w-100" type="submit">
                Войти
            </button>
        </div>
    </div>
</form>