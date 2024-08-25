<style>
    .tag {
        display: inline-block;
        padding: 5px;
        margin: 5px;
        background-color: #007bff;
        color: #fff;
        border-radius: 3px;
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
