<?php

namespace RaifuCore\Support\Services;

use RaifuCore\Support\Dto\FilterDto;

class Pagination
{
    protected int $total = 0; // Total number of items (database results)
    protected int $limit = 0; // Max number of items you want shown per page
    protected int $numLinks = 4; // Number of "digit" links to show before/after the currently viewed page
    protected int|string $page = 1; // The current page being viewed
    protected int $allValue = 0; // The current page being viewed

    protected string $firstLabel = ''; // The text of the "Start" button. If FALSE, then 1
    protected string $nextLabel = '>';
    protected string $prevLabel = '<';
    protected string $lastLabel = ''; // The text of the "End" button. If FALSE, the last page is displayed.

    protected string $view = 'raifucore::pagination';

    public function __construct(FilterDto $filter = null)
    {
        if ($filter) {
            $this->initFromFilter($filter);
        }
    }

    public function setView(string $view): self
    {
        $this->view = $view;

        return $this;
    }

    private function initFromFilter(FilterDto $filter): void
    {
        $this->page = $filter->has('page') ? $filter->get('page') : $this->page;

        $this->limit = $filter->has('limit') ? $filter->get('limit') : $this->limit;

        $this->total = $filter->getTotal();
    }

    /**
     * Generates an array of navigation elements and returns the result of the template rendering.
     */
    public function getHTML(): string|null
    {
        $get = filter_input_array(INPUT_GET) ?: [];

        // remove page from GET
        if (isset($get['page'])) {
            unset($get['page']);
        }

        // creating a base URL without GET parameters
        $uri = trim(filter_input(INPUT_SERVER, 'REQUEST_URI'));
        $parts = parse_url($uri);
        $baseUrl = $parts['path'];

        // Counting the number of pages
        $numPages = $this->limit > 0
            ? ceil($this->total / $this->limit)
            : 1;
        if ($numPages < 2) {
            return null;
        }

        // The correctness of entering the page number
        $this->page = $this->page != $this->allValue && floor($this->page)
            ? $this->page
            : $this->allValue;
        if ($this->page != $this->allValue && $this->page < 1) {
            redirect($baseUrl . $this->_buildGetQuery($get, 1));
        }
        if ($this->page != $this->allValue && $this->page > $numPages) {
            redirect($baseUrl . $this->_buildGetQuery($get, $numPages));
        }

        $result = [];

        // The "All" element
        $result[] = [
            'name' => __('raifucore::pagination.allLabel'),
            'current' => $this->page === $this->allValue,
            'href' => $baseUrl . $this->_buildGetQuery($get, $this->allValue),
            'title' => __('raifucore::pagination.allTitle'),
        ];

        // The "To the first" element
        if (is_numeric($this->page) && $this->page > $this->numLinks + 1) {
            $result[] = [
                'name' => $this->firstLabel ?: 1,
                'current' => false,
                'href' => $baseUrl . $this->_buildGetQuery($get, '1'),
                'title' => __('raifucore::pagination.firstTitle'),
            ];
        }

        // The "To previous" element
        if (is_numeric($this->page) && $this->page > 1) {
            $result[] = [
                'name' => $this->prevLabel,
                'current' => false,
                'href' => $baseUrl . $this->_buildGetQuery($get, $this->page - 1),
                'title' => __('raifucore::pagination.previousTitle'),
            ];
        }

        // A number of previous pages
        if (is_numeric($this->page)) {
            for ($i = $this->numLinks; $i >= 1; $i--) {
                if ($this->page - $i > 0) {
                    $result[] = [
                        'name' => $this->page - $i,
                        'current' => false,
                        'href' => $baseUrl . $this->_buildGetQuery($get, $this->page - $i),
                        'title' => __('raifucore::pagination.pageTitle', ['page' => $this->page - $i]),
                    ];
                }
            }
        }

        // The current element
        if ($this->page !== $this->allValue) {
            $result[] = [
                'name' => $this->page,
                'current' => true,
                'href' => $baseUrl . $this->_buildGetQuery($get, $this->page),
                'title' => '',
            ];
        }

        // A number of subsequent pages
        for ($i = 1; $i <= $this->numLinks; $i++) {
            $page = is_numeric($this->page) ? $this->page : 0;
            if ($page + $i <= $numPages) {
                $result[] = [
                    'name' => $page + $i,
                    'current' => false,
                    'href' => $baseUrl . $this->_buildGetQuery($get, $page + $i),
                    'title' => __('raifucore::pagination.pageTitle', ['page' => $page + $i]),
                ];
            }
        }

        // The "Next" element
        if (is_numeric($this->page)) {
            if ($this->page < $numPages) {
                $result[] = [
                    'name' => $this->nextLabel,
                    'current' => false,
                    'href' => $baseUrl . $this->_buildGetQuery($get, $this->page + 1),
                    'title' => __('raifucore::pagination.nextTitle'),
                ];
            }
        }

        // The "Last" element
        if (is_numeric($this->page) && $this->page < ($numPages - $this->numLinks)) {
            $result[] = [
                'name' => $this->lastLabel ?: $numPages,
                'current' => false,
                'href' => $baseUrl . $this->_buildGetQuery($get, $numPages),
                'title' => __('raifucore::pagination.lastTitle'),
            ];
        }

        return view($this->view, ['items' => $result])->render();
    }

    /**
     * Returns a string of GET parameters. If $page is passed, this array element is added/updated.
     */
    private function _buildGetQuery(array $get = [], int $page = null): string
    {
        if (!is_null($page)) {
            $get['page'] = $page;
        }
        return $get ? rawurldecode('?' . http_build_query($get)) : '';
    }
}
