<?php


    namespace App;


    trait RecordsActivity
    {
        public $oldAttributes = [];

        /**
         * Boot the trait.
         */
        public static function bootRecordsActivity()
        {
            foreach (self::RecordableEvents() as $event) {
                static::$event(function ($model) use ($event) {
                    $model->recordActivity($model->activityDescription($event));
                });

                if ($event === 'updated') {
                    static::updating(function ($model) {
                        $model->oldAttributes = $model->getOriginal();
                    });
                }
            }
        }

        public function activityDescription($description)
        {
            return "{$description}_" . strtolower(class_basename($this));
        }

        /**
         * @return array
         */
        public static function RecordableEvents()
        {
            if (isset(static::$recordableEvents)) {
                return static::$recordableEvents;
            }

            return ['created', 'updated', 'deleted'];
        }

        public function recordActivity($description)
        {
            $this->activity()->create([
                'user_id' => ($this->project ?? $this)->owner->id,
                'description' => $description,
                'changes'     => $this->activityChanges(),
                'project_id'  => class_basename($this) === 'Project' ? $this->id : $this->project_id
            ]);
        }

//        public function activityOwner()
//        {
            // Doorh hereggui
//            if (auth()->check()) {
//                return auth()->user();
//            }

//            if (class_basename($this) === 'Project') {
//                return $this->owner;
//            }
//
//            return $this->project->owner;

            // Doorhiig INLINE bolgoj bolno.
//            $project = $this->project ?? $this;
//
//            return $project->owner;

                // Deer ene function iig byheld ni inline bolgoj bolno.
//            return ($this->project ?? $this)->owner;
//        }

        public function activity()
        {
            return $this->hasMany(Activity::class)->latest();
        }

        public function activityChanges()
        {
            if ($this->wasChanged()) {
                return [
                    'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                    'after' => array_except($this->getChanges(), 'updated_at')
                ];
            }
        }
    }
