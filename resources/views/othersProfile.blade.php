<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        section {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
        }

        header h2 {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #007BFF;
            text-align: center;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .space-y-6 > * + * {
            margin-top: 24px;
        }

        .tag {
            display: inline-block;
            padding: 8px 12px;
            margin: 5px 3px;
            background-color: #007bff;
            color: white;
            border-radius: 20px;
            font-size: 14px;
        }

        .styled-button {
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease, transform 0.3s ease;
            display: block;
            width: 80%;
            margin: 30px auto 0;
            text-align: center;
        }

        .styled-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }

        .styled-button:active {
            background-color: #003d80;
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .block {
            display: block;
            width: 100%;
            padding: 5px 0;
            color: #555;
        }

        .mt-1 {
            margin-top: 8px;
        }

        img.rounded-full {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 10px auto;
            display: block;
        }

        .text-gray-600 {
            color: #6b7280;
            text-align: center;
        }

        .text-lg {
            font-size: 18px;
        }

        .font-medium {
            font-weight: 500;
        }

        .text-gray-900 {
            color: #111827;
        }

        .selected-skills {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        @media (max-width: 600px) {
            .styled-button {
                width: 90%;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>

<section>
    <header>
        <h2>{{ __('Profile Information') }}</h2>
    </header>

    <div class="mt-6 space-y-6">

        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            <div class="mt-1">
                @if ($user->profile_photo)
                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="rounded-full w-24 h-24">
                @else
                    <p class="text-gray-600">No profile photo available.</p>
                @endif
            </div>
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <p class="mt-1 block">{{ $user->name }}</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <p class="mt-1 block">{{ $user->email }}</p>
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <p class="mt-1 block">{{ ucfirst($user->gender) }}</p>
        </div>

        <div>
            <x-input-label for="university" :value="__('University')" />
            <p class="mt-1 block">{{ $user->university }}</p>
        </div>

        <div>
            <x-input-label for="degree" :value="__('Degree')" />
            <p class="mt-1 block">{{ $user->degree }}</p>
        </div>

        <div>
            <x-input-label for="year" :value="__('Year')" />
            <p class="mt-1 block">{{ $user->year }}</p>
        </div>

        <!-- Display Skills -->
        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <div class="selected-skills" id="selected_skills"></div>
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <p class="mt-1 block">{{ $user->dob }}</p>
        </div>

        <div>
            <x-input-label for="personal_description" :value="__('Personal Description')" />
            <p class="mt-1 block">{{ $user->personal_description }}</p>
        </div>

        <div>
            <x-input-label for="hobbies" :value="__('Hobbies')" />
            <p class="mt-1 block">{{ $user->hobbies }}</p>
        </div>

        <div>
            <x-input-label for="enrollment_type" :value="__('Enrollment Type')" />
            <p class="mt-1 block">{{ ucfirst($user->enrollment_type) }}</p>
        </div>

    </div>

    <a href="{{ url('./message/'.$user->id) }}">
        <button class="styled-button">Message</button>
    </a>
</section>

<script>
    const addedSkills = new Set();

    function addSkill(skill) {
        if (addedSkills.has(skill.name)) return;

        addedSkills.add(skill.name);

        const selectedSkillsDiv = document.getElementById('selected_skills');
        const tag = document.createElement('span');
        tag.className = 'tag';
        tag.textContent = skill.name;
        selectedSkillsDiv.appendChild(tag);
    }

    function loadTags() {
        let skills = "{{ $user->skills }}".trim();

        if (skills) {
            const skillsArray = skills.split(";");

            skillsArray.forEach(skill => {
                if (skill) {
                    addSkill({ name: skill.trim() });
                }
            });
        }
    }

    loadTags();
</script>

</body>
</html>
