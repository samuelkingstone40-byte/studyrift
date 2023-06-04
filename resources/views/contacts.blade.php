@extends('layouts.default')
@section('content')
<section class="contact_area section_gap ">
    <div class="container ">
      <h3 class="my-4"><b>Please get in touch with us.</b></h3>
      <p class="text-muted">Do you have an issue or a question?</p>
      <p>No problem, complete the form. You may use this form to i. Get in touch with us if you have any general queries or issues</p>
      <div class="row">
        <div class="col-lg-3">
          <div class="contact_info">
            <div class="">
              <ul>
                <li><p>Notify authorities if there is any suspicious activity.</p></li>
                <li><p>Complain about cheating</p></li>
                <li><p>File a copyright complaint</p></li>
              </ul>
              
            </div>
           
          </div>
        </div>
        <div class="col-lg-9">
          <form
            class="row contact_form"
            action="contact_process.php"
            method="post"
            id="contactForm"
            novalidate="novalidate"
          >
            <div class="col-md-6">
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  placeholder="Enter your name"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter your name'"
                  required=""
                />
              </div>
              <div class="form-group">
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="Enter email address"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter email address'"
                  required=""
                />
              </div>
              <div class="form-group">
                <input
                  type="text"
                  class="form-control"
                  id="subject"
                  name="subject"
                  placeholder="Enter Subject"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter Subject'"
                  required=""
                />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <textarea
                  class="form-control"
                  name="message"
                  id="message"
                  rows="1"
                  placeholder="Enter Message"
                  onfocus="this.placeholder = ''"
                  onblur="this.placeholder = 'Enter Message'"
                  required=""
                ></textarea>
              </div>
            </div>
            <div class="col-md-12 text-right">
              <button type="submit" value="submit" class="btn primary-btn">
                Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection