<style>
    .tag {
        display: inline-block;
        padding: 5px;
        margin: 5px;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
    }
    .styled-button {
        background-color: #007BFF; /* 按钮背景颜色 */
        color: white; /* 按钮文字颜色 */
        border: none; /* 去掉边框 */
        border-radius: 5px; /* 圆角 */
        padding: 10px 20px; /* 内边距 */
        font-size: 28px; /* 字体大小 */
        font-weight: bold; /* 字体加粗 */
        cursor: pointer; /* 鼠标悬停时显示手型光标 */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* 阴影效果 */
        transition: background-color 0.3s ease, transform 0.3s ease; /* 过渡效果 */
        width: 80%;
        margin-left: 10%;
        height: 80px;
    }

    .styled-button:hover {
        background-color: #0056b3; /* 悬停时背景颜色 */
        transform: translateY(-2px); /* 悬停时上移效果 */
    }

    .styled-button:active {
        background-color: #003d80; /* 点击时背景颜色 */
        transform: translateY(0); /* 点击时还原位置 */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* 点击时阴影缩小 */
    }
</style>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
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
            <p class="mt-1 block w-full">{{ $user->name }}</p>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <p class="mt-1 block w-full">{{ $user->email }}</p>
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <p class="mt-1 block w-full">{{ ucfirst($user->gender) }}</p>
        </div>

        <div>
            <x-input-label for="university" :value="__('University')" />
            <p class="mt-1 block w-full">{{ $user->university }}</p>
        </div>

        <div>
            <x-input-label for="degree" :value="__('Degree')" />
            <p class="mt-1 block w-full">{{ $user->degree }}</p>
        </div>

        <div>
            <x-input-label for="year" :value="__('Year')" />
            <p class="mt-1 block w-full">{{ $user->year }}</p>
        </div>

        <!-- Display Skills -->
        <div>
            <x-input-label for="skills" :value="__('Skills')" />
            <div class="selected-skills" id="selected_skills"></div>
        </div>

        <div>
            <x-input-label for="birthday" :value="__('Birthday')" />
            <p class="mt-1 block w-full">{{ $user->dob }}</p>
        </div>

        <div>
            <x-input-label for="personal_description" :value="__('Personal Description')" />
            <p class="mt-1 block w-full">{{ $user->personal_description }}</p>
        </div>

        <div>
            <x-input-label for="hobbies" :value="__('Hobbies')" />
            <p class="mt-1 block w-full">{{ $user->hobbies }}</p>
        </div>

        <div>
            <x-input-label for="enrollment_type" :value="__('Enrollment Type')" />
            <p class="mt-1 block w-full">{{ ucfirst($user->enrollment_type) }}</p>
        </div>

    </div>

    <a href="{{ url("./message/".$user->id) }}"><button class="styled-button">Message</button></a>
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
