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

                 try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
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
                            console.log(result.errors[error]);
                            $(`#${error}-error`).append(`<p>${result.errors[error]}</p>`);
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

    <h1>Create Book</h1>
    <form method="POST" action="{{ route('books.store') }}">
        @method('POST')
        @csrf
        <x-forms.form-container>
            <div class="flex flex-col">
                <x-forms.input-text
                    id="title"
                    placeholder="Enter title of book"
                    type="text"
                    name="title"
                    value=""
                />
                <div id="title-error" class="error-container text-red-500 text-sm h-5"></div>
            </div>

            <div class="flex flex-col">
                <x-forms.input-text
                    id="author_id"
                    placeholder="Enter id of author"
                    name="author_id"
                    value=""
                />
                <div id="author_id-error" class="error-container text-red-500 text-sm h-5"></div>
            </div>

            <div class="flex flex-col">
                <x-forms.input-date
                    id="published_date"
                    name="published_date"
                    value=""
                />
                <div id="published_date-error" class="error-container text-red-500 text-sm h-5"></div>
            </div>
            <button class="submit-btn hover:cursor-pointer bg-blue-600 text-white p-1 rounded-sm" type="submit"> Submit </button>
        </x-forms.form-container>
        
    </form>
@endsection