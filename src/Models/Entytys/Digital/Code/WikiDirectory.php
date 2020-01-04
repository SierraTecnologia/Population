<?php

/**
 * This file is part of Gitonomy.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 * (c) Julien DIDIER <genzo.wm@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class WikiDirectory extends Base
{

    protected $organizationPerspective = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'committer_id',
        'token',
        'company_token',
        'is_active'
    ];
    /*# frozen_string_literal: true

class WikiDirectory
  include ActiveModel::Validations

  attr_accessor :slug, :pages

  validates :slug, presence: true

  def initialize(slug, pages = [])
    @slug = slug
    @pages = pages
  end

  # Relative path to the partial to be used when rendering collections
  # of this object.
  def to_partial_path
    'projects/wikis/wiki_directory'
  end
end*/

}