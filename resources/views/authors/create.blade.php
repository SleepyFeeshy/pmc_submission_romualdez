@extends('layouts.app')

@section('content')   
    <script>
        $(document).ready(function() {
            $('form').on('submit', async function(e) {
                $('.error-container').empty();
                // Read the attributes
                console.log('Submitting')
                e.preventDefault()

                const form = this;
                const submitBtn = $(form).find('.submit-btn');
                const errorContainer = $('#error-container');
                const errorList = $('#error-list');

                 try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: new FormData(form) // Automatically includes name, birth_date, and _token
                    });

                    const result = await response.json();
                    console.log(result)
                    if (!response.ok) {
                        // Handle Laravel validation failure (Status 422)
                        console.log(Object.keys(result.errors))
                        if (response.status === 422) {
                            Object.keys(result.errors).forEach((error) => {
                            const errorMessage = result.errors[error]
                            console.log(errorMessage);
                            $(`#${error}-error`).append(`<p>${errorMessage}</p>`);
                        })
                        } else {
                            throw new Error(result.message || 'Something went wrong.');
                        }
                    } else {
                        // Success! Handle your post-submission logic here
                        alert('Author saved successfully!');
                        form.reset(); // Optionally clear the form fields
                    }

                } catch (error) {
                    errorContainer.removeClass('hidden');
                    errorList.append(`<li>${error.message}</li>`);
                } finally {
                    // Re-enable the submit button
                    submitBtn.prop('disabled', false).text('Submit');
                }
            });
        })
    </script>

    <form method="POST" action="{{ route('authors.store') }}">
        @method('POST')
        @csrf
        <x-forms.form-container>
            <div class="flex flex-col">
                <x-forms.input-text 
                    id="name" 
                    placeholder="Enter name of author" 
                    name="name"
                    value=""
                />
                <div id="name-error" class="error-container text-red-500 text-sm h-5"></div>
            </div>

            <div class="flex flex-col">
                <x-forms.input-date
                    id="birth_date"
                    name="birth_date"
                />
                <div id="birth_date-error" class="error-container text-red-500 text-sm h-5"></div>
            </div>
            
        </x-forms.form-container>
        <button class="submit-btn hover:cursor-pointer bg-blue-600 text-white p-1 rounded-sm" type="submit"> Submit </button>
        
    </form>


@endsection