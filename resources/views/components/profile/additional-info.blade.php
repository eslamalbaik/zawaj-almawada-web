<div class="space-y-6">
    <h3 class="text-lg font-semibold text-purple-700 border-b-2 border-purple-200 pb-2">
        <i class="fas fa-comment-dots text-purple-600 mr-2"></i>
        معلومات إضافية
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2 space-y-2">
            <div class="flex items-center gap-2 bg-purple-50 p-4 rounded-lg border border-purple-100">
                <div class="shrink-0 text-purple-600">
                    <i class="fas fa-info-circle"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    اذكر في هذا القسم: هواياتك، اهتماماتك، مهاراتك، صفاتك وطباعك، العادات، الأشياء التي تضايقك، طموحك
                    المستقبلي، أهدافك من الزواج، كيف تصف نفسك
                </p>
            </div>
            <x-profile.textarea-field name="personal_description" label="الوصف الشخصي"
                :value="old('personal_description', $user->personal_description)"
                placeholder="ابدأ بكتابة وصفك الشخصي هنا..." icon="pen" rows="4"
                :error="$errors->first('personal_description')" />
        </div>

        <div class="md:col-span-2 space-y-2">
            <div class="flex items-center gap-2 bg-pink-50 p-4 rounded-lg border border-pink-100">
                <div class="shrink-0 text-pink-600">
                    <i class="fas fa-heart"></i>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    حدد المواصفات المطلوبة: (العمر، المنطقة، الوضع الاجتماعي، اللباس، الجمال، التدين، المستوى التعليمي،
                    العمل، الفكر والثقافة، الصفات المرغوبة وغير المرغوبة، الموانع)
                </p>
            </div>
            @php
                $initialValue = old('partner_expectations', $user->partner_expectations) ?? '';
            @endphp
            <div
                x-data="{
                    wordCount: 0,
                    text: {{ Js::from($initialValue) }},
                    countWords() {
                        this.wordCount = this.text.trim().split(/\s+/).filter(word => word.length > 0).length;
                    }
                }"
                x-init="countWords()"
                class="space-y-2"
            >
                <x-profile.textarea-field 
                    name="partner_expectations" 
                    label="مواصفات الشريك"
                    :value="$initialValue"
                    x-model="text"
                    placeholder="اكتب المواصفات المطلوبة هنا (٥٠ كلمة على الأقل)..." 
                    icon="search" 
                    rows="4"
                    :error="$errors->first('partner_expectations')"
                    @input="countWords"
                    x-bind:class="{'border-red-300 focus:border-red-500 focus:ring-red-500': wordCount < 50 && text.length > 0}"
                />
                <div class="flex items-center justify-between px-2">
                    <div class="text-sm" x-bind:class="{
                        'text-red-600': wordCount < 50 && text.length > 0,
                        'text-green-600': wordCount >= 50,
                        'text-gray-500': text.length === 0
                    }">
                        <span x-text="wordCount"></span> / 50 كلمة
                        <template x-if="wordCount < 50 && text.length > 0">
                            <span class="text-red-600">
                                (يلزم <span x-text="50 - wordCount"></span> كلمة إضافية)
                            </span>
                        </template>
                        <template x-if="wordCount >= 50">
                            <span class="text-green-600">
                                <i class="fas fa-check-circle mr-1"></i>
                                تم الوصول للحد الأدنى المطلوب
                            </span>
                        </template>
                    </div>
                    <div class="relative w-24 h-1 bg-gray-200 rounded-full overflow-hidden">
                        <div 
                            class="absolute top-0 left-0 h-full transition-all duration-300 rounded-full"
                            x-bind:class="{
                                'bg-red-500': wordCount < 25,
                                'bg-yellow-500': wordCount >= 25 && wordCount < 50,
                                'bg-green-500': wordCount >= 50
                            }"
                            x-bind:style="'width: ' + (Math.min(wordCount / 50 * 100, 100)) + '%'"
                        ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>