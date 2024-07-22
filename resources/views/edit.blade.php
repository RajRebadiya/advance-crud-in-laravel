<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        HTML CSSResult Skip Results Iframe body {
            width: 100%;
            height: 100vh;
            margin: 0;
            background-color: #1b1b32;
            color: #f5f6f7;
            font-family: Tahoma;
            font-size: 16px;
        }

        h1,
        p {
            margin: 1em auto;
            text-align: center;
        }

        form {
            width: 60vw;
            max-width: 500px;
            min-width: 300px;
            margin: 0 auto;
            padding-bottom: 2em;
        }

        fieldset {
            border: none;
            padding: 2rem 0;
            border-bottom: 3px solid #3b3b4f;
        }

        fieldset:last-of-type {
            border-bottom: none;
        }

        label {
            display: block;
            margin: 0.5rem 0;
        }

        input,
        textarea,
        select {
            margin: 10px 0 0 0;
            width: 100%;
            min-height: 2em;
        }

        input,
        textarea {
            background-color: #0a0a23;
            border: 1px solid #0a0a23;
            color: #ffffff;
        }

        .inline {
            width: unset;
            margin: 0 0.5em 0 0;
            vertical-align: middle;
        }

        input[type="submit"] {
            display: block;
            width: 60%;
            margin: 1em auto;
            height: 2em;
            font-size: 1.1rem;
            background-color: #3b3b4f;
            border-color: white;
            min-width: 300px;
        }

        input[type="file"] {
            padding: 1px 2px;
        }

        .inline {
            display: inline;
        }

        a {
            color: #dfdfe2;
        }
    </style>
</head>

<body>
    <h1>Registration Form</h1>
    <form method="post" action='{{ route('edit') }}' enctype="multipart/form-data">
        @csrf
        <fieldset>
            <label for="first-name">Enter Your Name: <input id="name" name="name" type="text"
                    value='{{ old('name') ?? $user->name }}' /></label>
            <label for="first-name">Enter Your Name: <input id="id" name="id" type="hidden"
                    value='{{ old('id') ?? $user->id }}' /></label>
            <input id="image" name="image" type="hidden" value='{{ $user->image }}' />
            @error('name')
                <span style='color: red;'>{{ $message }}</span>
            @enderror

            <label for="email">Enter Your Email: <input id="email" name="email" type="email"
                    value='{{ old('email') ?? $user->email }}' /></label>
            @error('email')
                <span style='color: red;'>{{ $message }}</span>
            @enderror

            <lable>Select Gender :</lable>
            @error('gender')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <label for="male"><input id="male" type="radio" value='male' name="gender" value="male"
                    class="inline" @if ($user->gender == 'male') checked @endif /> Male</label>
            <label for="female"><input id="female" type="radio" value='female' name="gender" class="inline"
                    @if ($user->gender == 'female') checked @endif />
                Female</label>

            <label for="referrer">Select City
                @error('city')
                    <span style='color: red;'>{{ $message }}</span>
                @enderror
                <select id="referrer" name="city">
                    <option @if ($user->city == 'surat') selected @endif value="surat">surat</option>
                    <option @if ($user->city == 'navsari') selected @endif value=" navsari">
                        navsari</option>
                    <option @if ($user->city == 'vadodra') selected @endif value=" vadodra">
                        vadodra</option>
                    <option @if ($user->city == 'bharuch') selected @endif value=" bharuch">
                        bharuch</option>
                </select>
            </label>

            <label for="hobby">Select Hobby :</label>
            @error('hobby')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            @php
                $hobbys = explode(',', $user->hobby);
            @endphp


            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='sing'
                    {{ in_array('sing', $hobbys) ? 'checked' : '' }} name="hobby[]" />Sing
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='travel'
                    {{ in_array('travel', $hobbys) ? 'checked' : '' }} name="hobby[]" />Travel
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='read'
                    {{ in_array('read', $hobbys) ? 'checked' : '' }} name="hobby[]" />Read
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='dance'
                    {{ in_array('dance', $hobbys) ? 'checked' : '' }} name="hobby[]" />Dance
            </label>
            @php
                $images = explode(',', $user->image);
            @endphp
            @foreach ($images as $item)
                <img src="{{ asset('storage/profile_image/' . $item) }}" width='100' height="60" alt="">
            @endforeach
            <label for="profile-picture">Upload a profile picture: <input id="profile-picture" type="file"
                    name="image[]" value="{{ old('image.*') }}" multiple /></label>
            @error('image')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <input type="submit" value="Submit" />
    </form>
</body>

</html>
