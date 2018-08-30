<?php


return [

    /**
     *
     * titles translations
     *
     */
    'titles' => [
        'categories' => 'التصنيفات',
        'add_category' => 'تصنيف جديد',
        'edit_category' => 'تحديث التصنيف',
    ],

    /**
     *
     * fields translations
     *
     */
    'fields' => [
        'name' => 'الاسم',
        'language' => 'اللغة',
        'categories' => 'التصنيفات'
    ],

    /**
     *
     * validation translations
     *
     */
    'validations' => [
        'name_required' => 'اسم التصنيف مطلوب',
        'name_min' => 'اسم التصنيف يجب أن يكون أكثر من 3 أحرف',
        'lang_required' => 'لغة التصنيف مطلوبة',
        'lang_in' => 'يجب اختيار اللغة العربية أو الانجليزية',
        'category_image_required' => 'صورة التصنيف مطلوبة',

    ],
    /**
     *
     * success messages
     *
     */
    'success' => [
        'stored' => 'تم حفظ التصنيف بنجاح',
        'can_delete' => 'يمكن حذف التصنيف',
        'deleted' => 'تم حذف التصنيف بنجاح',
        'updated' => 'تم تحديث التصنيف بنجاح'
    ],
    /**
     *
     * error messages
     *
     */
    'error' => [
        'stored' => 'حدث خلل أثناء حفظ التطبيق',
        'can_not_delete' => 'لايمكن حذف التصنيف لان هناك كتب مرتبطة بها',
        'deleted' => 'حدث خلل أثناء حذف التصنيف',
        'not_found' => 'التصنيف غير موجود',
    ],

    /**
     *
     * questions
     *
     */
    'questions' => [
        'do_remove' => 'هل تريد حذف التصنيف ؟'
    ]


];