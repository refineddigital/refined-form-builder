@section('scripts')
<script src="{{ mix('/js/FormBuilder.js', '/vendor/refined/core') }}"></script>
<script>
  let form{{$form->id}} = document.querySelector('.form--{{ $form->id }}');
  let validate{{$form->id}} = new window.FormValidate();
@if($form->recaptcha == 2)
  let formSubmitted{{ $form->id }} = false;
  function submitForm{{ $form->id }}() {
    formSubmitted{{ $form->id }} = true;
    form.submit();
  }
@endif
  form{{$form->id}}.addEventListener('submit', function(e) {
    let errors{{$form->id}} = validate{{$form->id}}.validate(this);
    if (errors{{$form->id}}.length) {
      e.preventDefault();
      validate{{$form->id}}.alert();
    }

    @yield('form-submit-injection')

  @if($form->recaptcha == 2)
    else {
      if (!formSubmitted{{ $form->id }}) {
        e.preventDefault();
        grecaptcha.execute();
      }
    }
  @endif
});
</script>

@if($form->recaptcha)
  <script src="//www.google.com/recaptcha/api.js" async defer></script>
@endif
@append
