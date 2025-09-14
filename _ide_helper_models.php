<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $img
 * @property int $category_id
 * @property string $audio_file
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Audio findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereAudioFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Audio withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Audio withoutTrashed()
 */
	class Audio extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $img
 * @property int $category_id
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Blog findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog withoutTrashed()
 */
	class Blog extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $img
 * @property string $file
 * @property string $meta_keywords
 * @property string $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Book findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Book withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Book withoutTrashed()
 */
	class Book extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $slug
 * @property string $img
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property int $section
 * @property bool $featured
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Audio> $audios
 * @property-read int|null $audios_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Blog> $blogs
 * @property-read int|null $blogs_count
 * @property-read \App\Models\User|null $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Fatwa> $fatawas
 * @property-read int|null $fatawas_count
 * @property-read \App\Models\User|null $updater
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Video> $videos
 * @property-read int|null $videos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category active()
 * @method static \Illuminate\Database\Eloquent\Builder|Category articles()
 * @method static \Illuminate\Database\Eloquent\Builder|Category audios()
 * @method static \Illuminate\Database\Eloquent\Builder|Category fatwas()
 * @method static \Illuminate\Database\Eloquent\Builder|Category featured($isFeatured = true)
 * @method static \Illuminate\Database\Eloquent\Builder|Category findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Category inSection($section)
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category videos()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Category withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Category withoutTrashed()
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $img
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Database\Factories\DurarDiniyaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya query()
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|DurarDiniya withoutTrashed()
 */
	class DurarDiniya extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $img
 * @property int $category_id
 * @property string|null $audio_file
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $creator
 * @property-read mixed $excerpt
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereAudioFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Fatwa withoutTrashed()
 */
	class Fatwa extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $file_name
 * @property string $file_type
 * @property string $file_size
 * @property string $file_status
 * @property int $file_sort
 * @property int $mediable_id
 * @property string $mediable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $mediable
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMediableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMediableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property string|null $route
 * @property string|null $module
 * @property string|null $as
 * @property string|null $icon
 * @property Permission|null $parent
 * @property int $parent_show
 * @property int $parent_original
 * @property int $sidebar_link
 * @property int $appear
 * @property int $ordering
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereAppear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereAs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereParentOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereParentShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereSidebarLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $appearedchildren
 * @property-read int|null $appearedchildren_count
 */
	class Permission extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $imageable_id
 * @property string $imageable_type
 * @property string $file_name
 * @property string|null $thumb_name
 * @property int|null $file_size
 * @property string|null $file_type
 * @property int $file_sort
 * @property bool $file_status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFileSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFileStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereThumbName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUpdatedAt($value)
 */
	class Photo extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property string|null $allowed_route
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $perms
 * @property-read int|null $perms_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereAllowedRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $slug
 * @property string $description
 * @property string|null $img
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro query()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhIntro withoutTrashed()
 */
	class SheikhIntro extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string|null $img
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage query()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|SheikhPage withoutTrashed()
 */
	class SheikhPage extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string|null $key
 * @property string|null $value
 * @property int $section
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Photo|null $firstMedia
 * @property-read \App\Models\Photo|null $lastMedia
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Photo> $photos
 * @property-read int|null $photos_count
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting active()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SiteSetting withoutTrashed()
 */
	class SiteSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property array $title
 * @property string|null $slug
 * @property array|null $subtitle
 * @property array|null $description
 * @property string|null $img
 * @property string|null $icon
 * @property array|null $btn_title
 * @property array|null $url
 * @property bool $show_btn_title
 * @property string $target
 * @property int $section
 * @property int $show_info
 * @property array|null $metadata_title
 * @property array|null $metadata_description
 * @property array|null $metadata_keywords
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Slider active()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider advertisorSliders()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider mainSliders()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereBtnTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereMetadataDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereMetadataKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereMetadataTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereShowBtnTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereShowInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUrl($value)
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $url
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property string|null $meta_slug
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereMetaSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|UsefulLink withoutTrashed()
 */
	class UsefulLink extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany roles()
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $mobile
 * @property string $password
 * @property string|null $user_image
 * @property int $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUserImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withRole(string $role)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $user_id
 * @property int $permission_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permission
 * @property-read int|null $permission_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $user
 * @property-read int|null $user_count
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermissions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermissions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermissions query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermissions wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserPermissions whereUserId($value)
 */
	class UserPermissions extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $youtube_id
 * @property string|null $thumbnail
 * @property int $category_id
 * @property string|null $meta_keywords
 * @property string|null $meta_description
 * @property \Illuminate\Support\Carbon|null $published_on
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int $views
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read \App\Models\User|null $creator
 * @property-read \App\Models\User|null $updater
 * @method static \Illuminate\Database\Eloquent\Builder|Video findSimilarSlugs(string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Video onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereMetaDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereMetaKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video wherePublishedOn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video whereYoutubeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Video withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Video withUniqueSlugConstraints(\Illuminate\Database\Eloquent\Model $model, string $attribute, array $config, string $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|Video withoutTrashed()
 */
	class Video extends \Eloquent {}
}

