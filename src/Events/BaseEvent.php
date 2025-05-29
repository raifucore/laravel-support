<?php

namespace RaifuCore\Support\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Context;
use RaifuCore\Support\Helpers\ServerHelper;
use RaifuCore\Support\Models\ModelField;

abstract class BaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string|null $traceId;
    public string|null $ip;
    public User|null $author;
    public Carbon $dateTime;

    /**
     * @var Collection<ModelField>
     */
    public Collection $changedFields;

    public function __construct()
    {
        $this->traceId = Context::get('_rc_trace_id');
        $this->ip = ServerHelper::realIP();
        $this->author = auth()->user();
        $this->dateTime = now();
    }

    protected function setChangedFields(Model $model): void
    {
        if (method_exists($model, 'getChangedFields')) {
            $this->changedFields = $model->getChangedFields();
        }
    }
}
