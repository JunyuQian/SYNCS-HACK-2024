<style>
    .tag {
        display: inline-block;
        padding: 5px;
        margin: 5px;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
    }
    .skill-list div {
        padding: 5px;
        margin: 5px;
        background-color: #f1f1f1;
        cursor: pointer;
    }
    .skill-list div:hover {
        background-color: #ddd;
    }
</style>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="profile_photo" :value="__('Profile Photo')" />
            <input id="profile_photo" name="profile_photo" type="file" class="mt-1 block w-full" />
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo')" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="gender" name="gender" type="text" required="required" autofocus="autofocus" autocomplete="gender">
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="university" :value="__('University')" />
            <x-text-input id="university" name="university" type="text" class="mt-1 block w-full" :value="old('university', $user->university)" required autofocus autocomplete="university" />
            <x-input-error class="mt-2" :messages="$errors->get('university')" />
        </div>

        <div>
            <x-input-label for="degree" :value="__('Degree')" />
            <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full" :value="old('degree', $user->degree)" required autofocus autocomplete="degree" />
            <x-input-error class="mt-2" :messages="$errors->get('degree')" />
        </div>

        <div>
            <x-input-label for="year" :value="__('Year')" />
            <x-text-input id="year" name="year" type="number" step="0.5" min="0.5" class="mt-1 block w-full" :value="old('year', $user->year)" required autofocus autocomplete="year" />
            <x-input-error class="mt-2" :messages="$errors->get('year')" />
        </div>

        <!-- Skill Input and Display -->
        <div>
            <label for="skill_input" class="mt-1 block w-full">Your Skills:</label>
            <input type="text" id="skill_input" class="mt-1 block w-full" onkeyup="searchSkills()">
            <div class="skill-list" id="skill_list"></div>
        </div>
        <div class="selected-skills" id="selected_skills"></div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <x-text-input
                id="birthday"
                name="birthday"
                type="date"
                class="mt-1 block w-full"
                :value="old('birthday', $user->dob)"
                required
                autofocus
                autocomplete="bday"
                max="{{ \Carbon\Carbon::today()->toDateString() }}"
            />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="personal description" :value="__('Personal Description')" />
            <x-text-input id="personal description" name="personal description" type="text" class="mt-1 block w-full" :value="old('personal description', $user->personal_description)" required autofocus autocomplete="personal description" />
            <x-input-error class="mt-2" :messages="$errors->get('personal description')" />
        </div>

        <div>
            <x-input-label for="hobbies" :value="__('Hobbies')" />
            <x-text-input id="hobbies" name="hobbies" type="text" class="mt-1 block w-full" :value="old('hobbies', $user->hobbies)" required autofocus autocomplete="hobbies" />
            <x-input-error class="mt-2" :messages="$errors->get('hobbies')" />
        </div>

        <div>
            <x-input-label for="enrollment_type" :value="__('Enrollment Type')" />
            <select class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="enrollment_type" name="enrollment_type" type="text" required="required" autofocus="autofocus" autocomplete="enrollment_type">
                <option value="full-time" {{ old('enrollment_type', $user->enrollment_type) == 'full-time' ? 'selected' : '' }}>Full-Time</option>
                <option value="part-time" {{ old('enrollment_type', $user->enrollment_type) == 'part-time' ? 'selected' : '' }}>Part-Time</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('enrollment_type')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>

    </form>
</section>
<x-tag/>

<script>
    // 示例技能池
    const skillPool = [
        { "id": 1, "name": "JavaScript" },
        { "id": 2, "name": "Python" },
        { "id": 3, "name": "Java" },
        { "id": 4, "name": "C++" },
        { "id": 5, "name": "Ruby" },
        { "id": 6, "name": "Go" },
        { "id": 7, "name": "PHP" },
        { "id": 8, "name": "Swift" },
        { "id": 9, "name": "Kotlin" },
        { "id": 10, "name": "TypeScript" },
        { "id": 11, "name": "SQL" },
        { "id": 12, "name": "Dart" },
        { "id": 13, "name": "Rust" },
        { "id": 14, "name": "Scala" },
        { "id": 15, "name": "Objective-C" },
        { "id": 16, "name": "Perl" },
        { "id": 17, "name": "Shell" },
        { "id": 18, "name": "R" },
        { "id": 19, "name": "Groovy" },
        { "id": 20, "name": "Haskell" },
        { "id": 21, "name": "Microsoft Word" },
        { "id": 22, "name": "Microsoft Excel" },
        { "id": 23, "name": "Microsoft PowerPoint" },
        { "id": 24, "name": "Google Sheets" },
        { "id": 25, "name": "Google Docs" },
        { "id": 26, "name": "Photoshop" },
        { "id": 27, "name": "Illustrator" },
        { "id": 28, "name": "InDesign" },
        { "id": 29, "name": "HTML" },
        { "id": 30, "name": "CSS" },
        { "id": 31, "name": "SEO" },
        { "id": 32, "name": "Project Management" },
        { "id": 33, "name": "Agile" },
        { "id": 34, "name": "Scrum" },
        { "id": 35, "name": "Spanish" },
        { "id": 36, "name": "French" },
        { "id": 37, "name": "German" },
        { "id": 38, "name": "Chinese" },
        { "id": 39, "name": "Japanese" },
        { "id": 40, "name": "Russian" }
    ];

    const addedSkills = new Set();

    // 基于 LIKE 匹配的简单函数
    function like(a, b) {
        const lowerA = a.toLowerCase();
        const lowerB = b.toLowerCase();
        return lowerB.includes(lowerA);
    }


    // 实时模糊搜索
    function searchSkills() {
        const input = document.getElementById('skill_input').value.toLowerCase();
        let matches = skillPool
            .map(skill => ({
                ...skill,
                matched: like(input, skill.name.toLowerCase())
            }))
            .filter(skill => skill.matched) // 只保留匹配的技能


        console.log(matches)
        matches.sort((a, b) => {
            return a.name.length - b.name.length
        })
        matches = matches.slice(0, 5); // 选择前五个

        displaySkills(matches);
    }


    // 显示匹配的技能
    function displaySkills(skills) {
        const list = document.getElementById('skill_list');
        list.innerHTML = ''; // 清空之前的内容

        skills.forEach(skill => {
            const option = document.createElement('div');
            option.textContent = skill.name;
            option.onclick = () => addSkill(skill);
            list.appendChild(option);
        });
    }

    // 添加技能标签
    function addSkill(skill) {
        if (addedSkills.has(skill.name)) return; // 如果已经添加过，返回

        addedSkills.add(skill.name);

        const selectedSkillsDiv = document.getElementById('selected_skills');
        const tag = document.createElement('span');
        tag.className = 'tag';
        // tag.textContent = skill.name;
        tag.innerHTML = `${skill.name}<input type="hidden" name="skills[]" value="${skill.name}">`
        tag.onclick = () => removeSkill(skill);
        selectedSkillsDiv.appendChild(tag);
    }

    // 移除技能标签
    function removeSkill(skill) {
        addedSkills.delete(skill.name);

        const selectedSkillsDiv = document.getElementById('selected_skills');
        const tags = selectedSkillsDiv.getElementsByClassName('tag');
        for (let i = 0; i < tags.length; i++) {
            if (tags[i].textContent === skill.name) {
                selectedSkillsDiv.removeChild(tags[i]);
                break;
            }
        }
    }

    function loadTags() {
        let skills = "{{ $user->skills }}"; // Retrieve the skills string from the server
        skills = skills.trim(); // Remove any leading/trailing whitespace

        if (skills) { // Check if there are any skills
            const skillsArray = skills.split(";"); // Split the skills string into an array

            skillsArray.forEach(skill => {
                if (skill) { // Ensure skill is not an empty string
                    addSkill({ name: skill.trim() }); // Add each skill as a tag
                }
            });
        }
    }
    loadTags()

</script>
