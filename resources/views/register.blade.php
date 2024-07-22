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
    <form method="post" action='{{ route('registration') }}' enctype="multipart/form-data">
        @csrf
        <fieldset>
            <label for="first-name">Enter Your Name: <input id="name" name="name" type="text"
                    value='{{ old('name') }}' /></label>
            @error('name')
                <span style='color: red;'>{{ $message }}</span>
            @enderror

            <label for="email">Enter Your Email: <input id="email" name="email" type="email"
                    value='{{ old('email') }}' /></label>
            @error('email')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <label for="new-password">Create a New Password: <input id="password" name="password"
                    value='{{ old('password') }}' type="password" /></label>
            @error('password')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <label for="new-password">Enter Password Again: <input id="cpassword" name="cpassword"
                    value='{{ old('cpassword') }}' type="password" /></label>
            @error('cpassword')
                <span style='color: red;'>{{ $message }}</span>
            @enderror

            <lable>Select Gender :</lable>
            @error('gender')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <label for="male"><input id="male" type="radio" value='male' name="gender" value="male"
                    class="inline" checked /> Male</label>
            <label for="female"><input id="female" type="radio" value='female' name="gender" class="inline" />
                Female</label>

            <label for="referrer">Select City
                @error('city')
                    <span style='color: red;'>{{ $message }}</span>
                @enderror
                <select id="referrer" name="city">
                    <option value="surat">surat</option>
                    <option value="navsari">navsari</option>
                    <option value="vadodra">vadodra</option>
                    <option value="bharuch">bharuch</option>
                </select>
            </label>

            <label for="hobby">Select Hobby :</label>
            @error('hobby')
                <span style='color: red;'>{{ $message }}</span>
            @enderror

            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='sing'
                    {{ in_array('sing', old('hobby', [])) ? 'checked' : '' }} name="hobby[]" />Sing
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='travel'
                    {{ in_array('travel', old('hobby', [])) ? 'checked' : '' }} name="hobby[]" />Travel
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='read'
                    {{ in_array('read', old('hobby', [])) ? 'checked' : '' }} name="hobby[]" />Read
            </label>
            <label for="terms-and-conditions">
                <input class="inline" id="" type="checkbox" value='dance'
                    {{ in_array('dance', old('hobby', [])) ? 'checked' : '' }} name="hobby[]" />Dance
            </label>

            <label for="profile-picture">Upload a profile picture: <input id="profile-picture" type="file"
                    name="image[]" value="{{ old('image.*') }}" multiple /></label>
            @error('image')
                <span style='color: red;'>{{ $message }}</span>
            @enderror
            <input type="submit" value="Submit" />
    </form>
</body>

</html>
