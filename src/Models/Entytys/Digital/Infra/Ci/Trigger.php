<?php

namespace Population\Models\Entytys\Digital\Infra\Ci;
    
use Support\Models\Base;

class Trigger extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'infra_ci_triggers';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'credit_card_id',
        'user_id',
    ];


    protected $mappingProperties = array(

        'customer_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'credit_card_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'docker_compose_file' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );


    /*# frozen_string_literal: true

    module Ci
    class Trigger < ActiveRecord::Base
        extend Gitlab::Ci::Model
        include IgnorableColumn
        include Presentable

        ignore_column :deleted_at

        belongs_to :project
        belongs_to :owner, class_name: "User"

        has_many :trigger_requests

        validates :token, presence: true, uniqueness: true

        before_validation :set_default_values

        def set_default_values
        self.token = SecureRandom.hex(15) if self.token.blank?
        end

        def last_trigger_request
        trigger_requests.last
        end

        def last_used
        last_trigger_request.try(:created_at)
        end

        def short_token
        token[0...4] if token.present?
        end

        def legacy?
        self.owner_id.blank?
        end

        def can_access_project?
        self.owner_id.blank? || Ability.allowed?(self.owner, :create_build, project)
        end
    end
    end
    */
}