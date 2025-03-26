@extends('layouts.front.front_layout')
@section('content')


<section class="contact-form-body">
  <div class="container">
    <div class="row justify-center text-center">
      <div class="col-xl-8 col-lg-10 pt-50">

        <h2 class="text-64 md:text-40 capitalize">How may we help you?</h2>
        <p class="lh-17 mt-30">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis porttitor tellus vel mauris scelerisque accumsan.
          Maecenas quis nunc sed sapien dignissim pulvinar. Se d at gravida.
        </p>
        <form id="contactUsForm" action="/send-email" method="POST">
          @csrf
          <div class="contactForm row y-gap-30 pt-60">

            <div class="col-md-6">

              <div class="form-input ">
                <input type="text" id="name" name="name" value="" required>
                <label class="lh-1 text-16 text-light-1">First Name</label>
                <span class="error-text text-danger" id="nameError"></span>
              </div>

            </div>
            <div class="col-md-6">

              <div class="form-input ">
                <input type="text" class="" id="lname" name="lname">
                <label class="lh-1 text-16 text-light-1">Last Name</label>
              </div>

            </div>
            <div class="col-12">

              <div class="form-input ">
                <input type="email" id="email" name="email" value="" required>
                <label class="lh-1 text-16 text-light-1">Email</label>
                <span class="error-text text-danger" id="emailError"></span>
              </div>

            </div>
            <div class="col-12">

              <div class="form-input ">
                <textarea class="border-1" rows="8" id="message" name="message" required></textarea>
                <label class="lh-1 ">Comment</label>
                <span class="error-text text-danger" id="messageError"></span>
              </div>

            </div>
            <div class="col-12">
              <button type="submit" class="button -md -type-2 w-1/1 bg-accent-2 -accent-1">SEND YOUR MESSAGE</button>
            </div>
            <div id="contact_form_loader" class="loader_front text-center"></div>
          </div>
        </form>
       
      </div>
    </div>
  </div>
</section>


@endsection

@push('scripts')
<script type="text/javascript">
  $('#contactUsForm').on('submit', function(e) {
    e.preventDefault();
    $('.error-text').text('');
    $('#contact_form_loader').show();

    let formElement = document.getElementById('contactUsForm');
    let formData = new FormData(formElement);

    let url = '/send-email';
    let method = 'POST';

    $.ajax({
      url: url,
      type: method,
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if (response.errors) {
          $('#contact_form_loader').hide();
          $.each(response.errors, function(field, errors) {
            $('#' + field + 'Error').html(errors[0].charAt(0).toUpperCase() + errors[0].slice(1));
          });
          let firstErrorField = $('.error-text').filter(function() {
            return $(this).text().trim() !== '';
          }).first();

          if (firstErrorField.length) {
            let errorFieldId = firstErrorField.attr('id').replace('Error', '');
            let errorField = $('#' + errorFieldId);
            let modalBody = $('.contact-form-body');
            let errorOffsetTop = errorField.offset().top;

            modalBody.animate({
              scrollTop: errorOffsetTop - 150 - modalBody.offset().top + modalBody.scrollTop()
            }, 500);
          }
        } else {
          $('#contact_form_loader').hide();
          $('#contactUsForm')[0].reset();
          toastr.success('Email sent successfully');
        }
      },
      error: function() {
        toastr.error('Failed to send email');
      }
    });
  });
</script>

@endpush