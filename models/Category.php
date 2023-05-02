<?php

    namespace app\models;

    use app\models\query\CategoryQuery;
    use app\models\query\ProductQuery;
    use Yii;
    use yii\helpers\FileHelper;
    use yii\helpers\Url;
    use yii\web\UploadedFile;

    /**
     * This is the model class for table "{{%category}}".
     *
     * @property int $id
     * @property string $title
     * @property string|null $description
     * @property string|null $image
     *
     * @property Product[] $products
     */
    class Category extends \yii\db\ActiveRecord
    {
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
            $filePath = 'uploads/categories/' . $name;
            if (!is_dir(dirname($filePath))) {
                FileHelper::createDirectory(dirname($filePath));
            }
            return Url::to($filePath);
        }

        public function getImage()
        {
            if (isset($this->image)) {
                return '/uploads/categories/' . $this->image;
            }
        }

        /**
         * {@inheritdoc}
         */
        public static function tableName(): string
        {
            return '{{%category}}';
        }

        /**
         * {@inheritdoc}
         */
        public function rules(): array
        {
            return [
                [['title'], 'required'],
                [['description'], 'string'],
                [['title'], 'string', 'max' => 20],
                [['title'], 'unique'],
                [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            ];
        }

        /**
         * Gets query for [[Products]].
         *
         * @return \yii\db\ActiveQuery|\app\models\query\ProductQuery
         */
        public function getProducts(): ProductQuery
        {
            return $this->hasMany(Product::class, ['category_id' => 'id']);
        }

        /**
         * {@inheritdoc}
         * @return \app\models\query\CategoryQuery the active query used by this AR class.
         */
        public static function find(): CategoryQuery
        {
            return new \app\models\query\CategoryQuery(get_called_class());
        }
    }
