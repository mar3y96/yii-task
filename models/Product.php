<?php

    namespace app\models;

    use app\models\query\CategoryQuery;
    use app\models\query\ProductQuery;
    use Yii;
    use yii\behaviors\TimestampBehavior;
    use yii\helpers\FileHelper;
    use yii\helpers\Url;
    use yii\web\UploadedFile;

    /**
     * This is the model class for table "{{%product}}".
     *
     * @property int $id
     * @property string $title
     * @property string|null $description
     * @property string|null $image
     * @property int|null $category_id
     * @property int|null $created_at
     *
     * @property Category $category
     */
    class Product extends \yii\db\ActiveRecord
    {
        /**
         * {@inheritdoc}
         */
        public static function tableName(): string
        {
            return '{{%product}}';
        }

        /**
         * {@inheritdoc}
         */
        public function rules(): array
        {
            return [
                [['title'], 'required'],
                [['description'], 'string'],
                [['category_id', 'created_at'], 'integer'],
                [['title', 'image'], 'string', 'max' => 100],
                [['title'], 'unique'],
                [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            ];
        }

        /**
         * {@inheritdoc}
         */
        public function attributeLabels(): array
        {
            return [
                'id' => 'ID',
                'title' => 'Title',
                'description' => 'Description',
                'image' => 'Image',
                'category_id' => 'Category',
                'created_at' => 'Created At',
            ];
        }

        public function behaviors(): array
        {
            $behaviors = parent::behaviors();
            $behaviors[] = [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ];
            return $behaviors;
        }

        /**
         * @var UploadedFile
         */
        public $uploadedImage;

        public function upload()
        {
            if (isset($this->uploadedImage)) {
                $name = time() . random_int(100, 9999) . "." . $this->uploadedImage->extension;
                $this->uploadedImage->saveAs($this->uploadPath($name));
                $this->image = $name;
                $this->save();
            }
        }

        public function uploadPath($name)
        {
            $filePath = 'uploads/products/' . $name;
            if (!is_dir(dirname($filePath))) {
                FileHelper::createDirectory(dirname($filePath));
            }
            return Url::to($filePath);
        }

        public function getImage()
        {
            if (isset($this->image)) {
                return '/uploads/products/' . $this->image;
            }
        }

        /**
         * Gets query for [[Category]].
         *
         * @return \yii\db\ActiveQuery|\app\models\query\CategoryQuery
         */
        public function getCategory(): CategoryQuery
        {
            return $this->hasOne(Category::class, ['id' => 'category_id']);
        }

        /**
         * {@inheritdoc}
         * @return \app\models\query\ProductQuery the active query used by this AR class.
         */
        public static function find(): ProductQuery
        {
            return new \app\models\query\ProductQuery(get_called_class());
        }
    }
