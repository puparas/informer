<ul class="dropdown-menu p-0">
    <li><a href="#" onclick="getModalForm('{{route('informer.edit', $project->id)}}')" class="dropdown-item" >Редактировать</a></li>
    @if($project->monitor_id)
        <li><a href="#" onclick="getModalForm('{{route('monitoring.show', $project->monitor_id)}}')" class="dropdown-item" >Результаты мониторинга</a></li>
    @endif
    <li><a href="#" onclick="getModalForm('{{$project->monitor_id ? route('monitoring.edit', $project->monitor_id) : route('monitoring.create', $project->id)}}')" class="dropdown-item" >Параметры мониторинга</a></li>
    <li><a href="#" onclick="dialog('{{route('informer.destroy', $project->id)}}')" class="dropdown-item text-bg-danger" >Удалить</a></li>
</ul>
